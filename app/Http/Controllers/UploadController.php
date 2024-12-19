<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCasesJob;
use App\Models\Category;
use App\Models\Docket;
use App\Models\Location;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;

class UploadController extends Controller
{
    use AuditTrailLog;
    public function showUploadCasesForm()
    {
        if (Gate::denies('Upload cases')) {

            $this->createAuditTrail("Denied access to  Upload cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Upload cases.']);
        }

        //show categories that have courts
        $categories = Category::fetchCategoriesWithCourt()->with('courts', 'courttypes')->orderBy('name', 'asc')->get();

        //show locations that have courts and has been assigned categories
        $locations = Location::fetchLocationsWithCourt()->whereHas('courts.categories')->orderBy('name', 'asc')->get();


        if (session('file_path')) {
            // Delete the temporary file after processing
            Storage::delete(session('file_path'));
            // Clear the session data after import
            session()->forget('import_data');
            session()->forget('file_path');
        }

        $this->createAuditTrail('Visited case upload page.');


        return view('dashboard.dockets.upload-cases', compact('categories', 'locations'));
    }


    public function previewUploadedFile(Request $request)
    {
        $request->validate([
            'case_category' => 'required|integer',
            'location' => 'required|integer',
            'case_file' => ['required', 'file', 'mimes:xlsx,csv'],
        ]);

        $category = Category::query()->findOrFail($request->case_category);
        $location = Location::query()->findOrFail($request->location);

        $filePath = $request->file('case_file')->store('temp', 'local');

        $rows = SimpleExcelReader::create(storage_path('app/private/' . $filePath))
            ->useHeaders(['suit_number', 'case_title']) //date_filed
            ->take(500)
            ->getRows();

        $allRows = $rows->map(function ($row) use ($category, $location) {
            // Adjust index based on the column for date_filed
            //            $filingDate = \DateTime::createFromFormat('dmY', $row['date_filed']);
            return [
                'suit_number' => $row['suit_number'],  // Adjust index based on the column for suit_number
                'case_title' => $row['case_title'],   // Adjust index based on the column for case_title
                //                'date_filed' => $filingDate ? $filingDate->format('Y-m-d') : now()->format('d-m-Y'),
                'case_category' => $category->name,
                'location' => $location->name,
            ];
        })->toArray();

        // Store the full dataset in the session
        session(['import_data' => $allRows]);
        session(['file_path' => $filePath]);

        // Get the first 10 rows for preview
        $previewRows = array_slice($allRows, 0, 15);


        $this->createAuditTrail('Uploaded ' . count($allRows) . ' records for preview');

        return view('dashboard.dockets.upload-preview', ['rows' => $previewRows, 'category' => $category, 'location' => $location]);
    }

    /**
     * process the csv file
     *
     * */

    public function processImport(Request $request)
    {

        // Retrieve the full dataset from the session
        $allRows = session('import_data', []);

        // Step 1: Insert all dockets in a single query
        $dockets = collect($allRows)->map(function ($row) use ($request) {
            return [
                'slug' => uniqid(),
                'suit_number' => strtoupper($row['suit_number']),
                'case_title' => strtoupper($row['case_title']),
                //                'date_filed' => $row['date_filed'],
                'category_id' => $request->case_category,
                'location_id' => $request->location,
                'status' => 'Filed',
                'created_by' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
        //insert
        Docket::query()->insert($dockets->toArray());

        // Step 2: Dispatch a single job for all dockets
        $insertedDockets = Docket::query()
            ->whereIn('slug', collect($dockets)->pluck('slug'))
            ->get();

        ProcessCasesJob::dispatch($insertedDockets, Auth::id());

        // Delete the temporary file after processing
        Storage::delete(session('file_path'));
        // Clear the session data after import
        session()->forget('import_data');
        session()->forget('file_path');

        return redirect()->route('cases')->with('success', 'Cases imported successfully.');
    }
}
