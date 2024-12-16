<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Docket;
use App\Models\Location;
use App\Services\CaseDistributionService;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ReAllocationController extends Controller
{
    use AuditTrailLog;


    protected $caseDistributionService;

    public function __construct(CaseDistributionService $caseDistributionService)
    {
        $this->caseDistributionService = $caseDistributionService;
    }


    public function allocationByCategory($slug)
    {
        if (Gate::denies('Re-assign cases')) {

            $this->createAuditTrail("Denied access to  Re-assign cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Re-assign cases.']);
        }

        //get docket
        $docket = Docket::query()->with('categories')->where('slug', $slug)->firstOrFail();

        //show categories that have courts
        $categories = Category::fetchCategoriesWithCourt()->with('courts')->orderBy('name', 'asc')->get();

        //show locations that have courts and has been assigned categories
        $locations = Location::fetchLocationsWithCourt()->whereHas('courts.categories')->orderBy('name', 'asc')->get();

        // create audit
        $this->createAuditTrail('Visited Re-allocation by category creation page.');


        return view('dashboard.dockets.re-assign-by-category', compact('docket', 'categories', 'locations'));
    }

    public function saveAllocationByCategory(Request $request)
    {

        $request->validate([
            'case_category' => ['required', 'integer'],
            'reason' => ['required', 'string'],
        ]);

        //get docket
        $docket = Docket::query()->with('categories')->where('slug', $request->slug)->firstOrFail();

        try {
            //initialize assigned court
            $assignedCourt = null;

            //start transaction
            DB::transaction(function () use ($request, &$assignedCourt, &$docket) {

                //update docket by changing category
                $docket->update([
                    'category_id' => $request->case_category,
                    'reason_for_manual_assignment' => $request->reason
                ]);


                //log case creation
                $this->createAuditTrail("Updated case with suit number $docket->suit_number by changing the category");


                // Step 2: re-assign the case using the service
                $assignedCourt = $this->caseDistributionService->assignCase($docket);

                // Log case assignment
                $this->createAuditTrail("Re-assigned the case with suit no $docket->suit_number to $assignedCourt->name successfully");
            });

            // Return success message after the transaction
            return to_route('cases.show', $docket->slug)->with('success', "The case with suit no $docket->suit_number has been re-allocated to $assignedCourt->name successfully");
        } catch (\Exception $e) {
            // Step 3: Handle failure

            Log::error("An error occurred during docket creation or allocation: " . $e->getMessage());

            return back()->withInput()->with('error', "An error occurred during the update and re-allocation. Try again");
        }
    }
}
