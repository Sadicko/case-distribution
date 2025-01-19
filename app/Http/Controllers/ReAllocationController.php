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


                $reassignment = CaseReassignment::query()->create([
                    'slug' => uniqid(),
                    'docket_id' => $docket->id,
                    'suit_number' => $docket->suit_number,
                    'case_title' => $docket->case_title,
                    'location_id' => $docket->location_id,
                    'category_id' => $request->case_category,
                    'case_stage' => $request->commercial_type ?? $docket->case_stage,
                    'reason_for_re_assignment' => $request->reason,
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

                // Fetch approvals dynamically based on the number of steps
                $approvals = [];
                for ($i = 1; $i <= $approvalSteps; $i++) {

                    $approval = User::permission($permissions[$i] ?? '')->whereNotIn('id', $approvals)->inRandomOrder()->first();

                    if ($approval) {
                        $approvals[$i] = $approval->id;
                    } else {
                        // Handle case where no approval is found for a step
                        throw new Exception("No approval found for step $i");
                    }
                }

                // Create approval steps
                foreach ($approvals as $step => $approvalId) {
                    CaseReassignmentApproval::query()->create([
                        'case_reassignment_id' => $reassignment->id,
                        'approved_by' => $approvalId,
                        'step' => $step,
                    ]);
                }


                //set docket for re-allocation
                $docket->update(['reassignment_initiated' => true]);

                //log case creation
                $this->createAuditTrail("Submitted the case with suit number $docket->suit_number by changing the category for reassignment");
            });

            // Return success message after the transaction
            return to_route('cases.show', $docket->slug)->with('success', "Rea-allocation Initiated. Awaiting approval");
        } catch (\Exception $e) {
            // Step 3: Handle failure

            Log::error("An error occurred during Reassignment submission for approval: " . $e->getMessage());

            return back()->withInput()->with('error', "No approval found for steps. Try again or contact Administrator.");
        }
    }


    public function reassign(Request $request)
    {

        $request->validate([
            'slug' => ['required', 'string'],
        ]);

        //fetch initiated docket for re-allocation
        $reAssignDocket = CaseReassignment::query()->with('dockets', 'categories', 'approvals')->where('slug', $request->slug)->firstOrFail();

        //check if current user has approval right or is the required person to approve.
        $approval = CaseReassignmentApproval::query()->where('case_reassignment_id', $reAssignDocket->id)
            ->where('is_approved', false)
            ->where('approved_by', Auth::id())
            ->first();

        if (!$approval) {
            return response()->json(['error' => 'You do not have pending approval or you are not authorized to approved this re-allocation.']);
        }


        //using transaction to ensure all query completes for assignments
        try {
            //initialize assigned court
            $assignedCourt = null;
            $message = null;

            //start transaction
            DB::transaction(function () use ($request, &$assignedCourt, &$message, &$approval, &$reAssignDocket) {

                //Set is_approve to true for current user
                $approval->update([
                    'is_approved' => true,
                ]);


                // Check if all approvals are done. Then update the docket itself and trigger re-assignment
                $pendingApprovals = CaseReassignmentApproval::query()->where('case_reassignment_id', $reAssignDocket->id)
                    ->where('is_approved', false)
                    ->count();

                if ($pendingApprovals == 0) {
                    //update initiated records
                    $reAssignDocket->update(['status' => 'approved']);

                    // Step 1: update the actual docket by changing category
                    $docket = $reAssignDocket->dockets;
                    $docket->update([
                        'category_id' => $reAssignDocket->category_id,
                        'reason_for_assignment' => $reAssignDocket->reason_for_re_assignment
                    ]);

                    //log re-allocation
                    $this->createAuditTrail("Approved step $approval->step for the case with suit number $reAssignDocket->suit_number for re-allocation.");

                    // Step 2: re-assign the case using the service
                    $assignedCourt = $this->caseDistributionService->assignCase($docket);

                    //set initiated to false. That means, case reallocated
                    $docket->update(['reassignment_initiated' => false]);

                    $message = "The case with suit no $docket->suit_number has been Re-allocated to $assignedCourt->name successfully";

                    // Log case assignment
                    $this->createAuditTrail("Re-allocated the case with suit no $docket->suit_number to $assignedCourt->name");
                } else {
                    //message after only approving
                    $message = "Approved step $approval->step for the case with suit number $reAssignDocket->suit_number for re-allocation.";
                    //log re-allocation
                    $this->createAuditTrail("Approved step $approval->step for the case with suit number $reAssignDocket->suit_number for re-allocation.");
                }
            });

            // Return success message after the transaction
            return response()->json(['success' => $message]);
        } catch (\Exception $e) {
            // Step 3: Handle failure

            Log::error("The approval process did not complete as expected. Re-allocation not done. Error: " . $e->getMessage());

            return response()->json(["error" => "The approval process did not complete as expected. Re-allocation not done. Please try again"]);
        }
    }


//    public function approveReassignment($request, $id)
//    {
//        $approval = CaseReassignmentApproval::query()->where('case_reassignment_id', $id)
//            ->where('is_approved', false)
//            ->where('approved_by', Auth::id())
//            ->first();
//
//        if (!$approval) {
//            return 'You do not have pending approval or you are not authorized to approved this re-allocation.';
//        }
//
//        // // Check if the user has already approved any step
//        // $alreadyApproved = CaseReassignmentApproval::where('case_reassignment_id', $id)
//        //     ->where('approved_by', Auth::id())
//        //     ->exists();
//
//        // if ($alreadyApproved) {
//        //     return 'You have already approved this re-allocation.';
//        // }
//
//        $approval->update([
//            'is_approved' => true,
//            'approved_by' => auth()->id(),
//        ]);
//
//        // Check if all approvals are done
//        $pendingApprovals = CaseReassignmentApproval::query()->where('case_reassignment_id', $id)
//            ->where('is_approved', false)
//            ->count();
//
//        if ($pendingApprovals == 0) {
//            $reassignment = CaseReassignment::query()->find($id);
//            $reassignment->update(['status' => 'approved']);
//            // Update docket or courts table as needed here
//        }
//
//        return redirect()->back()->with('success', 'Approval successful.');
//    }
}
