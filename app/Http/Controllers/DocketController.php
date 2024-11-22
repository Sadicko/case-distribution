<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Docket;
use App\Models\Location;
use App\Services\CaseDistributionService;
use App\Traits\AuditTrailLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // create audit
        $this->createAuditTrail('Visited cases page.');

        return view('dashboard.dockets.index');
    }

    public function createCase()
    {
        //show locations that have courts and has been assigned categories
        $categories = Category::query()->whereHas('courts', function ($qeury){
            $qeury->where('availability', 1);
        })->orderBy('name', 'asc')->get();

        //show locations that have courts and has been assigned categories
        $locations = Location::query()->whereHas('courts', function ($qeury){
            $qeury->where('availability', 1);
        })->whereHas('courts.categories')->orderBy('name', 'asc')->get();

        // create audit
        $this->createAuditTrail('Visited case creation page.');

        return view('dashboard.dockets.create', compact('categories', 'locations'));
    }

    public function saveCase(Request $request)
    {
//        return $request;
        $request->validate([
            'suit_number' => ['required', 'string', 'regex:/^[A-Z]{2,5}\/\d{4,5}\/\d{4}$/'],
            'case_title' => ['required', 'string'],
            'case_category' => ['required', 'integer'],
            'location' => ['required', 'integer'],
            'priority_level' => ['required', 'string'],
        ]);

        // check if suit number exist
        if($this->isCaseRegistered()){
            return back()->withInput()->withErrors(['suit_number' => 'The suit number is already taken.']);
        }

        $docket = Docket::query()->create([
            'slug' => $slug = Str::slug($request->suit_number),
            'suit_number' => $request->suit_number,
            'case_title' => $request->case_title,
            'category_id' => $request->case_category,
            'location_id' => $request->location,
            'date_filed' => Carbon::createFromFormat('d/m/Y', $request->date_filed),
            'priority_level' => $request->priority_level,
            'status' => 'Filed',
            'created_by' => Auth::id(),
        ]);

        //log case creation
        $this->createAuditTrail("Created a case with suit number $docket->suit_number");

        try {

            $assignedCourt = $this->caseDistributionService->assignCase($docket);

            $this->createAuditTrail("Assigned the case with suit no $docket->suit_number to $assignedCourt->name successfully");

            return back()->with('success', "Assigned the case with suit no $docket->suit_number to $assignedCourt->name successfully");


        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
//            return response()->json([
//                'success' => false,
//                'message' => $e->getMessage(),
//            ], 400);
        }

    }

    /**
     * @return bool
     */
    public function isCaseRegistered(): bool
    {
        return Docket::query()->where(['suit_number' => request()->suit_number, 'category_id' => request()->case_category, 'location_id' => request()->location])->exists();
    }

}
