<?php

namespace App\Http\Controllers;

use App\Models\CaseReassignment;
use App\Models\CaseReassignmentApproval;
use App\Models\Category;
use App\Models\Docket;
use App\Models\Location;
use App\Models\User;
use App\Services\CaseDistributionService;
use App\Traits\AuditTrailLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Exceptions;
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

        if ($docket->reassignment_initiated) {
            return back()->withInput()->with('error', "Re-allocation has already been initiated for this case and currently awaiting approval.");
        }

        try {
            //initialize assigned court
            $assignedCourt = null;

            //start transaction
            DB::transaction(function () use ($request, &$assignedCourt, &$docket) {


                $reassignment = CaseReassignment::create([
                    'slug' => uniqid(),
                    'docket_id' => $docket->id,
                    'suit_number' => $docket->suit_number,
                    'case_title' => $docket->case_title,
                    'location_id' => $docket->location_id,
                    'category_id' => $request->case_category,
                    'case_stage' => $request->commercial_type ?? $docket->case_stage,
                    'reason_for_manual_assignment' => $request->reason,
                    'submitted_by' => Auth::id(),
                    'status' => 'pending',
                ]);

                // Get the number of approval steps from the .env file
                $approvalSteps = env('APPROVAL_STEPS', 1);

                // Define the permissions for each step
                $permissions = [
                    1 => 'Approve step one',
                    2 => 'Approve step two',
                    3 => 'Approve step three',
                ];

                // Fetch approvers dynamically based on the number of steps
                $approvers = [];
                for ($i = 1; $i <= $approvalSteps; $i++) {

                    $approver = User::permission($permissions[$i] ?? '')->whereNotIn('id', $approvers)->inRandomOrder()->first();

                    if ($approver) {
                        $approvers[$i] = $approver->id;
                    } else {
                        // Handle case where no approver is found for a step
                        throw new Exception("No approver found for step $i");
                    }
                }

                // Create approval steps
                foreach ($approvers as $step => $approverId) {
                    CaseReassignmentApproval::create([
                        'case_reassignment_id' => $reassignment->id,
                        'approved_by' => $approverId,
                        'step' => $step,
                    ]);
                }


                //set docket for re-allocation
                $docket->update(['reassignment_initiated' => true]);

                //log case creation
                $this->createAuditTrail("Submitted the case with suit number $docket->suit_number by changing the category for reassignment");
            });

            // Return success message after the transaction
            return to_route('cases.show', $docket->slug)->with('success', "Reassignment Initiated. Awaiting approval");
        } catch (\Exception $e) {
            // Step 3: Handle failure

            Log::error("An error occurred during Reassignment submission for approval: " . $e->getMessage());

            return back()->withInput()->with('error', "No approver found for steps. Try again or contact Administrator.");
        }
    }


    public function reassign(Request $request)
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
