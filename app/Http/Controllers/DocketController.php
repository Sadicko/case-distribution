<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Category;
use App\Models\Docket;
use App\Models\Location;
use App\Services\CaseDistributionService;
use App\Traits\AuditTrailLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if (Gate::denies('Manage cases')) {

            $this->createAuditTrail("Denied access to  Manage cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage cases.']);
        }
        // create audit
        $this->createAuditTrail('Visited cases page.');

        return view('dashboard.dockets.index');
    }

    public function showCase($slug)
    {
        $docket = Docket::query()
            ->with([
                'courts',
                'judges',
                'categories',
                'locations',
                'creators',
                'disposers',
                'docketlogs.users',
                'allocations.courts',
                'allocations.judges',
                'allocations.locations',
                'reallocations' => function ($query) {
                    $query->where('status', 'pending')
                        ->select('id', 'docket_id', 'status')
                        ->withCount(['approvals' => function ($subQuery) {
                            $subQuery->where('is_approved', 1);
                        }]);
                }
            ])
            ->where('slug', $slug)
            ->firstOrFail();


        return view('dashboard.dockets.show', compact('docket'));
    }

    public function createCase()
    {
        if (Gate::denies('Create cases')) {

            $this->createAuditTrail("Denied access to  Create cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create cases.']);
        }

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
            'suit_number' => ['required', 'string', 'regex:/^[aA-zZ]{2,5}\/\d{4,5}\/\d{4}$/'],
            'case_title' => ['required', 'string'],
            'case_category' => ['required', 'integer'],
            'commercial_type' => ['required_if:case_category,1', 'nullable'],
            'location' => ['required', 'integer'],
            'priority_level' => ['required', 'string'],
        ], [
            'commercial_type.required_if' => 'The commercial type field is required when the case category is Commercial.',
        ]);


        // check if suit number exist
        if ($this->isCaseRegistered()) {

            // create audit
            $this->createAuditTrail("Attempted to create a case with suit number $request->suit_number but already exists.");

            return back()->withInput()->withErrors(['suit_number' => 'The suit number is already taken.']);
        }

        //allocation process
        try {
            //initialize assigned court
            $assignedCourt = null;
            $docket = null;

            //start transaction
            DB::transaction(function () use ($request, &$assignedCourt, &$docket) {
                // Step 1: Create the docket
                $docket = Docket::query()->create([
                    'slug' => Str::slug($request->suit_number) . '-' .  uniqid(),
                    'suit_number' => strtoupper($request->suit_number),
                    'case_title' => strtoupper($request->case_title),
                    'category_id' => $request->case_category,
                    'case_stage' => $request->commercial_type ?? 'Trial',
                    'reason_for_assignment' => 'New',
                    'location_id' => $request->location,
                    //'date_filed' => Carbon::createFromFormat('d/m/Y', $request->date_filed),
                    'priority_level' => $request->priority_level,
                    'status' => 'Filed',
                    'created_by' => Auth::id(),
                ]);

                //log case creation
                $this->createAuditTrail("Created a case with suit number $docket->suit_number");


                // Step 2: Assign the case using the service
                $assignedCourt = $this->caseDistributionService->assignCase($docket);

                // Log case assignment
                $this->createAuditTrail("Assigned the case with suit no $docket->suit_number to $assignedCourt->name successfully");
            });

            // Return success message after the transaction
            return back()->with('success', "The case with suit no $docket->suit_number created and allocated to $assignedCourt->name successfully");
        } catch (\Exception $e) {
            // Step 3: Handle failure

            Log::error("An error occurred during docket creation or assignment: " . $e->getMessage());

            return back()->withInput()->with('error', "An error occurred during Case creation or assignment. Try again");
        }
    }


    public function getManuelAllocationForm()
    {
        if (Gate::denies('Manual case allocation')) {

            $this->createAuditTrail("Denied access to  Manual case allocation: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manual case allocation.']);
        }

        //show categories that have courts
        $categories = Category::fetchCategoriesWithCourt()->with('courts')->orderBy('name', 'asc')->get();

        //show locations that have courts and has been assigned categories
        $locations = Location::fetchLocationsWithCourt()->whereHas('courts.categories')->orderBy('name', 'asc')->get();

        // create audit
        $this->createAuditTrail('Visited  manual allocation page.');

        return view('dashboard.dockets.manuel-allocation', compact('categories', 'locations'));
    }

    public function saveManuelAllocation(Request $request)
    {

        if (Gate::denies('Manual case allocation')) {

            $this->createAuditTrail("Denied access to  Manual case allocation: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manual case allocation.']);
        }

        $request->validate([
            'suit_number' => ['required', 'string', 'regex:/^[A-Z]{2,5}\/\d{4,5}\/\d{4}$/'],
            'case_title' => ['required', 'string'],
            'case_category' => ['required', 'integer'],
            'commercial_type' => ['required_if:case_category,1', 'nullable'],
            'location' => ['required', 'integer'],
            'court' => ['required', 'integer'],
            'judge' => ['required', 'integer'],
            'date_assignment' => ['required', 'date_format:d/m/Y H:i'],
            'priority_level' => ['required', 'string'],
            'reason' => ['required', 'string'],
        ]);

        // check if suit number exist
        if ($this->isCaseRegistered()) {

            $this->createAuditTrail("Attempted to create a case with suit number $request->suit_number but already exists.");

            return back()->withInput()->withErrors(['suit_number' => 'The suit number is already taken.']);
        }

        try {
            $docket = null;

            DB::transaction(function () use ($request, &$docket) {
                //create manual docket
                $docket = Docket::query()->create([
                    'slug' => Str::slug($request->suit_number) . '-' . uniqid(),
                    'suit_number' => strtoupper($request->suit_number),
                    'case_title' => strtoupper($request->case_title),
                    'category_id' => $request->case_category,
                    'case_stage' => $request->commercial_type ?? 'Trial',
                    'location_id' => $request->location,
                    'court_id' => $request->court,
                    'judge_id' => $request->judge,
                    'assigned_date' => Carbon::createFromFormat('d/m/Y H:i', $request->date_assignment),
                    'priority_level' => $request->priority_level,
                    'reason_for_assignment' => $request->reason,
                    'status' => 'Assigned',
                    'is_assigned' => 1,
                    'assign_type' => 'manual',
                    'created_by' => Auth::id(),
                ]);

                //create allocation copy
                Allocation::query()->create([
                    'docket_id' => $docket->id,
                    'court_id' => $docket->court_id,
                    'judge_id' => $docket->judge_id,
                    'location_id' => $docket->location_id,
                    'assigned_by' => $docket->created_by,
                    'assignment_reason' => $docket->reason_for_assignment,
                    'assigned_date' => $docket->assigned_date,
                    'case_stage' => $docket->case_stage ?? 'Trial',
                ]);
            });

            $this->createAuditTrail("Created a manual case with suit number $docket->suit_number");
        } catch (\Exception $e) {

            Log::info("An error occurred during the manual docket creation or assignment: " . $e->getMessage());

            return back()->withInput()->with('error', 'An error occurred during the manual case creation or assignment. Try again.');
        }

        //log case creation

        return back()->with('success', 'Manual case created successfully!');
    }


    public function showEditCase($slug)
    {
        if (Gate::denies('Update cases')) {

            $this->createAuditTrail("Denied access to  Update cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update cases.']);
        }

        $docket = Docket::query()->with('categories', 'locations')->where('slug', $slug)->firstOrFail();

        //show categories that have courts
        $categories = Category::fetchCategoriesWithCourt()->with('courts')->orderBy('name', 'asc')->get();

        //show locations that have courts and has been assigned categories
        $locations = Location::fetchLocationsWithCourt()->whereHas('courts.categories')->orderBy('name', 'asc')->get();


        return view('dashboard.dockets.edit', compact('docket', 'categories', 'locations'));
    }

    public function updateCase(Request $request, $slug)
    {
        $request->validate([
            'suit_number' => ['required', 'string', 'regex:/^[aA-zZ]{2,5}\/\d{4,5}\/\d{4}$/'],
            'case_title' => ['required', 'string'],
            'case_category' => ['nullable', 'integer'],
            'location' => ['nullable', 'integer'],
            'priority_level' => ['nullable', 'string'],
        ]);


        // check if suit number exist
        if ($this->isCaseExist()) {

            // create audit
            $this->createAuditTrail("Attempted to update a case with suit number $request->suit_number but already exists.");

            return back()->withInput()->withErrors(['suit_number' => 'The suit number is already taken.']);
        }

        $docket = Docket::query()->where('slug', $slug)->firstOrFail();

        $docket->update([
            'suit_number' => strtoupper($request->suit_number),
            'case_title' => strtoupper($request->case_title),
            'category_id' => $request->case_category ?? $docket->category_id,
            'location_id' => $request->location ?? $docket->location_id,
        ]);

        return back()->with('success', 'Case updated successfully!');
    }


    /**
     * @return bool
     */
    public function isCaseRegistered(): bool
    {
        return Docket::query()->where(['suit_number' => request()->suit_number, 'category_id' => request()->case_category, 'location_id' => request()->location])->exists();
    }

    public function isCaseExist(): bool
    {
        //used when updating
        return Docket::query()->where(['suit_number' => request()->suit_number, 'category_id' => request()->case_category, 'location_id' => request()->location])
            ->where('slug', '!=', request()->slug)->exists();
    }


    public function printCase($slug)
    {
        if (Gate::denies('Print cases')) {

            $this->createAuditTrail("Denied access to  Print cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Print cases.']);
        }

        $docket = Docket::query()->with('courts', 'courts.currentJudge', 'categories', 'locations')->where(['slug' => $slug])->firstOrFail();

        $this->createAuditTrail("Visited printing page for case with suit number $docket->suit_number");

        return view('dashboard.dockets.print', compact('docket'));
    }

    public function downloadCase($slug)
    {
        if (Gate::denies('Download cases')) {

            $this->createAuditTrail("Denied access to  Download cases: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Download cases.']);
        }

        $docket = Docket::query()->with('courts', 'courts.currentJudge', 'categories', 'locations')->where(['slug' => $slug])->firstOrFail();

        $this->createAuditTrail("Downloaded case with suit number $docket->suit_number");

        // Generate the PDF from the Blade view
        $pdf = PDF::loadView('dashboard.dockets.download', compact('docket'))->setPaper('a5', 'portrait');

        // Download the PDF
        return $pdf->download(Str::slug($docket->suit_number) . '.pdf');
    }
}
