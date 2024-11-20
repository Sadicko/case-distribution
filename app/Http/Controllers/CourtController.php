<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Courttype;
use App\Models\Location;
use App\Models\Region;
use App\Models\Registry;
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

        $courts = Court::query()->with('currentJudge')->latest()->get();

        $this->createAuditTrail('Visited court page.');

        return view('dashboard.courts.index', compact('courts'));
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
            'name' => $request->court_name,
            'code' => $request->court_code,
            'status' => $request->status,
            'courttype_id' => $request->court_type,
            'registry_id' => $request->registry,
            'location_id' => $request->location,
            'region_id' => $location->region_id,
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
        // $regions = Region::orderby('name', 'asc')->get();

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
        ]);

        if ($this->courtNameExist()) {
            return back()->withInput()->withErrors(['name' => 'The location name is already taken.']);
        }

        $court =  Court::whereslug($slug)->firstOrfail();
        $location = Location::find($request->location);

        $court->update([
            'name' => $request->court_name,
            'code' => $request->court_code,
            'status' => $request->status,
            'courttype_id' => $request->court_type,
            'location_id' => $request->location,
            'registry_id' => $request->registry,
            'region_id' => $location->region_id,
        ]);


        if($request->status == 'Move to trash'){

            if(Gate::denies('Delete courts')){

                $this->createAuditTrail("Denied access to  Update courts: Unauthorized");

                return back()->with(['error' => 'You are not authorized to Update courts.']);
            }

            $this->createAuditTrail("Moved the court #$court->name to trash");

            $court->delete();

            return to_route('courts')
                ->with('warning', 'Court moved to trash successfully.');
        }


        $this->createAuditTrail("Update a the court #$court->name.");

        return back()->with('success', 'Court updated successfully.');
    }
}
