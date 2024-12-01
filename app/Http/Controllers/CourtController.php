<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Court;
use App\Models\Courttype;
use App\Models\Location;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CourtController extends Controller
{
    use AuditTrailLog;

    public function index()
    {
        if(Gate::denies('Manage courts')){

            $this->createAuditTrail("Denied access to  Manage courts: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage courts.']);
        }

        $courts = Court::query()->with('currentJudge', 'locations', 'courttypes', 'registries', 'categories')->latest()->get();

        $this->createAuditTrail('Visited court page.');

        return view('dashboard.courts.index', compact('courts'));
    }


    public function showCourt($slug)
    {
        $court = Court::query()->with('courtlogs', 'courtlogs.users')->where('slug', $slug)->firstOrFail();

        return view('dashboard.courts.show', compact('court'));
    }

    public function create()
    {
        if(Gate::denies('Create courts')){

            $this->createAuditTrail("Denied access to  Create courts: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create courts.']);
        }

        $courttypes = Courttype::query()->where('status', 'Published')->get();
        // $regions =  Region::where('country_id', 84)->orderby('name', 'asc')->get();
        // $locations =  Location::where('status', 'Published')->orderby('name', 'asc')->get();
        // $registries =  Registry::where('status', 'Published')->orderby('name', 'asc')->get();

        $this->createAuditTrail('Visited court onboarding page.');

        return view('dashboard.courts.create', compact('courttypes'));
    }


    public function store(Request $request)
    {
        if(Gate::denies('Create courts')){

            $this->createAuditTrail("Denied access to  Create courts: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create courts.']);
        }

        $request->validate([
            'court_name' => ['required', 'string', 'max:255'],
            'court_code' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'court_type' => ['required', 'integer'],
            'registry' => ['nullable', 'integer'],
            'location' => ['required', 'integer'],
            // 'region' => ['required', 'integer'],
        ]);

        if ($this->courtNameExist()) {

            $this->createAuditTrail("Tried to add a court name #$request->court_name which already exist.");

            return back()->withInput()->withErrors(['court_name' => 'The court name is already taken.']);

        }

        $location = Location::query()->find($request->location);

        $court = Court::query()->create([
            'name' => strtoupper($request->court_name),
            'code' => $request->court_code,
            'status' => $request->status,
            'courttype_id' => $request->court_type,
            'registry_id' => $request->registry,
            'location_id' => $request->location,
            'region_id' => $location->region_id,
            'availability' => 1,
            'slug' => str_shuffle(uniqid()),
            'created_by' => Auth::id(),
        ]);

        $this->createAuditTrail("Added a new court #$court->name");

        return back()->with('success', 'Court created successfully.');
    }


    // determine name exist
    public function  courtNameExist()
    {
        return Court::query()->where('slug', '!=', request()->slug)->where('name', request()->court_name)->first();
    }


    public function edit($slug){

        if(Gate::denies('Update courts')){

            $this->createAuditTrail("Denied access to  Update courts: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update courts.']);
        }

        $court =  Court::whereslug($slug)->firstOrfail();
        $courttypes = Courttype::latest()->get();

        $this->createAuditTrail('Visited edit court page.');

        return view('dashboard.courts.edit', compact('courttypes', 'court'));
    }


    public function update(Request $request, $slug){

        if(Gate::denies('Update courts')){

            $this->createAuditTrail("Denied access to  Update courts: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update courts.']);
        }

        $request->validate([
            'court_name' => ['required', 'string', 'max:255'],
            'court_code' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'court_type' => ['required', 'integer'],
            'location' => ['required', 'integer'],
            'registry' => ['nullable', 'integer'],
            'current_workload' => ['nullable', 'numeric'],
            'new_workload' => ['nullable', 'numeric'],
        ]);

        if ($this->courtNameExist()) {
            return back()->withInput()->withErrors(['name' => 'The location name is already taken.']);
        }

        $court =  Court::whereslug($slug)->firstOrfail();
        $location = Location::query()->find($request->location);

        $court->update([
            'name' => strtoupper($request->court_name),
            'code' => $request->court_code,
            'status' => $request->status,
            'courttype_id' => $request->court_type,
            'location_id' => $request->location,
            'registry_id' => $request->registry,
            'region_id' => $location->region_id,
            'availability' => $request->get('availability') ? 1 : 0,
        ]);

        if ($request->new_workload && Gate::allows('Reset workloads')){
            $court->update([
                'case_count' => $request->new_workload,
            ]);
        }


        if($request->status == 'Move to trash'){

            if(Gate::denies('Delete courts')){

                $this->createAuditTrail("Denied access to  Delete courts: Unauthorized");

                return back()->with(['error' => 'You are not authorized to Delete courts.']);
            }

            $this->createAuditTrail("Moved the court #$court->name to trash");

            $court->delete();

            return to_route('courts')
                ->with('warning', 'Court moved to trash successfully.');
        }


        $this->createAuditTrail("Update a the court #$court->name.");

        return back()->with('success', 'Court updated successfully.');
    }

    public function assignCategories($slug)
    {
        if(Gate::denies('Assign categories courts')){

            $this->createAuditTrail("Denied access to  Assign categories courts: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Assign categories courts.']);
        }

        $court = Court::query()->with('categories')->where('slug', $slug)->firstOrfail();

        $categories =  Category::query()->where('courttype_id', $court->courttype_id)->get();

        $this->createAuditTrail('Visited categories assign page.');

        return view('dashboard.courts.assign-categories', compact('court', 'categories'));
    }

    public function saveCourtCategories(Request $request, $slug)
    {
        if(Gate::denies('Assign categories courts')){

            $this->createAuditTrail("Denied access to  Assign categories courts: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Assign categories courts.']);
        }

        $court = Court::query()->where('slug', $slug)->firstOrfail();

        // Sync the categories
        $court->categories()->sync($request->categories);

        $this->createAuditTrail('Assigned '. count($request->categories). "categories to the court #". $court->name);

        return to_route('courts')->with('success', count($request->categories).' categories assigned to '.$court->name.' successfully.');

    }

    public function fetchCourts(Request $request)
    {
        if($request->wantsJson()){

            $courts = Court::query()->where('registry_id', $request->registry)->get();

            return response()->json($courts);
        }

        abort(404);

    }

}
