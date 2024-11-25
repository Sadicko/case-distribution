<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Registry;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RegistryController extends Controller
{
    use AuditTrailLog;

    public function index(){

        if(Gate::denies('Manage registries')){

            $this->createAuditTrail("Denied access to  Manage registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage registries.']);
        }

        $registries = Registry::withCount('courts')->orderby('name')->get();

        $this->createAuditTrail("Visited Registry List page.");

        return view('dashboard.registries.index', compact('registries'));
    }

    public function create(){

        if(Gate::denies('Create registries')){

            $this->createAuditTrail("Denied access to  Manage registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage registries.']);
        }

        $locations = Location::orderby('name', 'asc')->get();

        $this->createAuditTrail("Visited Registry creation page");

        return view('dashboard.registries.create', compact('locations'));
    }

    public function store(Request $request){

        if(Gate::denies('Create registries')){

            $this->createAuditTrail("Denied access to  Create registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create registries.']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'registry_code' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'location' => ['required', 'integer'],
        ]);

        if ($this->registryNameExist()) {
            return back()->withInput()->withErrors(['name' => 'The registry name is already taken.']);
        }

        if ($this->registryCodeExist()) {
            return back()->withInput()->withErrors(['registry_code' => 'The registry code is already taken.']);
        }

        $registry = Registry::create([
            'name' => $request->name,
            'code' => $request->registry_code,
            'email' => $request->email,
            'status' => $request->status,
            'location_id' => $request->location,
            'region_id' => Location::find($request->location)->region_id,
            'slug' => str_shuffle(uniqid()),
        ]);

        $this->createAuditTrail("Created a new Registry $registry->name");

        return back()->with('success', 'Registry created successfully.');
    }



    public function edit($slug){

        if(Gate::denies('Update registries')){

            $this->createAuditTrail("Denied access to  Update registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update registries.']);
        }

        $registry =  Registry::whereslug($slug)->firstOrfail();
        $locations = Location::orderby('name', 'asc')->get();

        $this->createAuditTrail("Visited Registry edit page.");

        return view('dashboard.registries.edit', compact('registry', 'locations'));
    }


    public function update(Request $request, $slug){

        if(Gate::denies('Update registries')){

            $this->createAuditTrail("Denied access to  Update registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update registries.']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'registry_code' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'location' => ['required', 'integer'],
        ]);

        if ($this->registryNameExist()) {
            return back()->withInput()->withErrors(['name' => 'The registry name is already taken.']);
        }

        if ($this->registryCodeExist()) {
            return back()->withInput()->withErrors(['registry_code' => 'The registry code is already taken.']);
        }

        $registry =  Registry::whereslug($slug)->firstOrfail();

        $region = $registry->location_id == $request->location ? $request->location : Location::find($request->location)->region_id;

        $registry->update([
            'name' => $request->name,
            'code' => $request->registry_code,
            'status' => $request->status,
            'email' => $request->email,
            'location_id' => $request->location,
            'region_id' => $region,
        ]);

        if($request->status == 'Move to trash'){

            if(Gate::denies('Delete registries')){

                $this->createAuditTrail("Denied access to  Delete registries: Unauthorized");

                return back()->with(['error' => 'You are not authorized to Delete registries.']);
            }

            $this->createAuditTrail("Deleted $registry->name");

            $registry->delete();

            return to_route('registries')
            ->with('warning', 'Location moved to trash successfully.');
        }

        $this->createAuditTrail("Udpated records for $registry->name registry");

        return back()->with('success', 'Registry updated successfully.');
    }


    // determine name exist
    public function  registryNameExist()
    {
        return Registry::where('slug', '!=', request()->slug)->where('name', request()->name)->first();
    }

    // determine code exist
    public function  registryCodeExist()
    {
        return Registry::where('slug', '!=', request()->slug)->where('code', request()->registry_code)->first();
    }


    public function fetchRegistry(Request $request){

        if($request->wantsJson()){

            $registries = Registry::where('location_id', $request->location)->get();

            return response()->json($registries);
        }

        abort(404);

    }


}
