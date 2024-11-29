<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Docket;
use App\Models\Location;
use App\Services\CaseDistributionService;
use App\Traits\AuditTrailLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DocketController extends Controller
{
    use AuditTrailLog;

    protected $caseDistributionService;

    public function __construct(CaseDistributionService $caseDistributionService)
    {
        $this->caseDistributionService = $caseDistributionService;
    }

    public function showCases()
    {
        if(Gate::denies('Manage cases')){

            $this->createAuditTrail("Denied access to  Manage cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage cases.']);
        }
        // create audit
        $this->createAuditTrail('Visited cases page.');

        return view('dashboard.dockets.index');
    }

    public function createCase()
    {
        if(Gate::denies('Create cases')){

            $this->createAuditTrail("Denied access to  Create cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create cases.']);
        }

        //get user
        //show categories that have courts
        $categories = Category::fetchCategoriesWithCourt()->with('courts')->orderBy('name', 'asc')->get();

        //show locations that have courts and has been assigned categories
        $locations = Location::fetchLocationsWithCourt()->whereHas('courts.categories')->orderBy('name', 'asc')->get();

        // create audit
        $this->createAuditTrail('Visited case creation page.');

        return view('dashboard.dockets.create', compact('categories', 'locations'));
    }

    public function saveCase(Request $request)
    {
        $request->validate([
            'suit_number' => ['required', 'string', 'regex:/^[A-Z]{2,5}\/\d{4,5}\/\d{4}$/'],
            'case_title' => ['required', 'string'],
            'case_category' => ['required', 'integer'],
            'location' => ['required', 'integer'],
            'priority_level' => ['required', 'string'],
        ]);

        // check if suit number exist
        if($this->isCaseRegistered()){

            $this->createAuditTrail("Attempted to create a case with suit number $request->suit_number but already exists.");
            // create audit
            $this->createAuditTrail('Visited cases page.');
            return back()->withInput()->withErrors(['suit_number' => 'The suit number is already taken.']);
        }

        $docket = Docket::query()->create([
            'slug' => $slug = Str::slug($request->suit_number),
            'suit_number' => strtoupper($request->suit_number),
            'case_title' => strtoupper($request->case_title),
            'category_id' => $request->case_category,
            'location_id' => $request->location,
//            'date_filed' => Carbon::createFromFormat('d/m/Y', $request->date_filed),
            'priority_level' => $request->priority_level,
            'status' => 'Filed',
            'created_by' => Auth::id(),
        ]);

        //log case creation
        $this->createAuditTrail("Created a case with suit number $docket->suit_number");

        try {

            $assignedCourt = $this->caseDistributionService->assignCase($docket);

            $this->createAuditTrail("Assigned the case with suit no $docket->suit_number to $assignedCourt->name successfully");

            return back()->with('success', "The case with suit no $docket->suit_number created and allocated to $assignedCourt->name successfully");


        } catch (\Exception $e) {

            $this->createAuditTrail("Created a case with suit number $docket->suit_number but redirected for manuel allocation due to the follow: ". $e->getMessage());

            //submit for manuel assignment
            $docket->assign_type = 'manuel';
            $docket->save();

            Log::info("The error below occurred and there for submitted for manual assignment: ". $e->getMessage());

            return back()->with('error', $e->getMessage());
        }

    }

    /**
     * @return bool
     */
    public function isCaseRegistered(): bool
    {
        return Docket::query()->where(['suit_number' => request()->suit_number, 'category_id' => request()->case_category, 'location_id' => request()->location])->exists();
    }


    public function printCase($slug)
    {
        if(Gate::denies('Print cases')){

            $this->createAuditTrail("Denied access to  Print cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Print cases.']);
        }

        $docket = Docket::query()->with('courts', 'courts.currentJudge', 'categories', 'locations')->where(['slug' => $slug])->firstOrFail();

        $this->createAuditTrail("Visited printing page for case with suit number $docket->suit_number");

        return view('dashboard.dockets.print', compact('docket'));
    }

    public function downloadCase($slug)
    {
        if(Gate::denies('Download cases')){

            $this->createAuditTrail("Denied access to  Download cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Download cases.']);
        }

        $docket = Docket::query()->with('courts', 'courts.currentJudge', 'categories', 'locations')->where(['slug' => $slug])->firstOrFail();

        $this->createAuditTrail("Downloaded case with suit number $docket->suit_number");

        // Generate the PDF from the Blade view
        $pdf = PDF::loadView('dashboard.dockets.download', compact('docket'))->setPaper('a4', 'portrait');

        // Download the PDF
        return $pdf->download(Str::slug($docket->suit_number) . '.pdf');
    }

}
