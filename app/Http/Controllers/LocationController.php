<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Courttype;
use App\Models\Location;
use App\Models\Region;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LocationController extends Controller
{
    use AuditTrailLog;

    public function index(){

        if(Gate::denies('Manage locations')){

            $this->createAuditTrail("Denied access to the location list page: Unauthorized");

            return back()->with(['error' => 'You are not authorized to access location list page.']);
        }


        $locations = Location::with('courttypes')->orderby('name')->get();

        $this->createAuditTrail("Visited location list page.");


        return view('dashboard.locations.index', compact('locations'));
    }

    public function create(){

        if(Gate::denies('Create locations')){

            $this->createAuditTrail("Denied access to create location: Unauthorized");

            return back()->with(['error' => 'You are not authorized to create location.']);
        }

        $regions = Region::query()->with('countries')->whereHas('countries', function ($query) {
            $query->where('code', 'GH');
        })->orderby('name', 'asc')->get();
        $courttypes = Courttype::query()->where('status', 'Published')->latest()->get();

        $this->createAuditTrail("Visited location creation page.");

        return view('dashboard.locations.create', compact('regions', 'courttypes'));
    }

    public function store(Request $request){
        if(Gate::denies('Create locations')){

            $this->createAuditTrail("Denied access to create location: Unauthorized");

            return back()->with(['error' => 'You are not authorized to create location.']);
        }

        $request->validate([
            'location_name' => ['required', 'string', 'max:255'],
            'location_code' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'court_type' => ['required', 'array'],
            'region' => ['required', 'integer'],
        ]);

        if ($this->locationNameExist()) {
            return back()->withInput()->withErrors(['location_name' => 'The location name is already taken.']);
        }

        $location = Location::query()->create([
            'name' => $request->location_name,
            'code' => $request->location_code,
            'status' => $request->status,
            'courttype_id' => $request->court_type,
            'region_id' => $request->region,
            'slug' => str_shuffle(uniqid()),
            'created_by' => Auth::id(),
        ]);

        $this->createAuditTrail("Created a new location $location->name");

        return back()->with('success', 'Location created successfully.');
    }


    // determine name exist
    public function  locationNameExist()
    {
        return Location::query()->where('slug', '!=', request()->slug)->where('name', request()->location_name)->first();
    }


    public function fetchLocations(Request $request){

        if($request->wantsJson()){

            $locations = Location::query()->where('courttype_id', $request->court_type)->get();

            return response()->json($locations);
        }

        abort(404);

    }


    public function edit($slug){

        if(Gate::denies('Update Locations')){

            $this->createAuditTrail("Denied access to update location: Unauthorized");

            return back()->with(['error' => 'You are not authorized to update location.']);
        }

        $location =  Location::query()->whereslug($slug)->firstOrfail();
        $regions = Region::query()->with('countries')->whereHas('countries', function ($query) {
            $query->where('code', 'GH');
        })->orderby('name', 'asc')->get();
        $courttypes = Courttype::query()->latest()->get();

        $this->createAuditTrail("Visited page to edit the location $location->name.");

        return view('dashboard.locations.edit', compact('location', 'regions', 'courttypes'));
    }


    public function update(Request $request, $slug){

        if(Gate::denies('Update Locations')){

            $this->createAuditTrail("Denied access to update location: Unauthorized");

            return back()->with(['error' => 'You are not authorized to update location.']);
        }

        $request->validate([
            'location_name' => ['required', 'string', 'max:255'],
            'location_code' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'court_type' => ['required', 'integer'],
            'region' => ['required', 'integer'],
        ]);

        if ($this->locationNameExist()) {
            return back()->withInput()->withErrors(['name' => 'The location name is already taken.']);
        }

        $location =  Location::query()->whereslug($slug)->firstOrfail();

        $location->update([
            'name' => $request->location_name,
            'code' => $request->location_code,
            'status' => $request->status,
            'courttype_id' => $request->court_type ?? null,
            'region_id' => $request->region,
        ]);


        if($request->status == 'Move to trash'){

            if(Gate::denies('Delete Locations')){

                $this->createAuditTrail("Denied access to delete location: Unauthorized");

                return back()->with(['error' => 'You are not authorized to delete a location.']);
            }

            $this->createAuditTrail("Deleted the location $location->name");

            $location->delete();

            return to_route('locations')
                ->with('warning', 'Location moved to trash successfully.');
        }

        $this->createAuditTrail("Edited records for the location $location->name");

        return back()->with('success', 'Location updated successfully.');
    }
}


