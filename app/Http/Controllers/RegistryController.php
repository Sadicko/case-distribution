<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courttype;
use App\Models\Location;
use App\Models\Registry;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RegistryController extends Controller
{
    use AuditTrailLog;

    public function index()
    {

        if (Gate::denies('Manage registries')) {

            $this->createAuditTrail("Denied access to  Manage registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage registries.']);
        }

        $registries = Registry::query()->withCount('courts')->with('categories')->orderby('name')->get();

        $this->createAuditTrail("Visited Registry List page.");

        return view('dashboard.registries.index', compact('registries'));
    }

    public function create()
    {

        if (Gate::denies('Create registries')) {

            $this->createAuditTrail("Denied access to  Manage registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage registries.']);
        }

        $locations = Location::orderby('name', 'asc')->get();
        $courttypes = Courttype::query()->where('status', 'Published')->latest()->get();

        $this->createAuditTrail("Visited Registry creation page");

        return view('dashboard.registries.create', compact('locations', 'courttypes'));
    }

    public function store(Request $request)
    {

        if (Gate::denies('Create registries')) {

            $this->createAuditTrail("Denied access to  Create registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create registries.']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'registry_code' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'court_type' => ['required', 'integer'],
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
            'courttype_id' => $request->court_type,
            'slug' => str_shuffle(uniqid()),
        ]);

        $this->createAuditTrail("Created a new Registry $registry->name");

        return back()->with('success', 'Registry created successfully.');
    }



    public function edit($slug)
    {

        if (Gate::denies('Update registries')) {

            $this->createAuditTrail("Denied access to  Update registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update registries.']);
        }

        $registry =  Registry::whereslug($slug)->firstOrfail();
        $locations = Location::orderby('name', 'asc')->get();
        $courttypes = Courttype::query()->where('status', 'Published')->latest()->get();

        $this->createAuditTrail("Visited Registry edit page.");

        return view('dashboard.registries.edit', compact('registry', 'locations', 'courttypes'));
    }


    public function update(Request $request, $slug)
    {

        // return $request;

        if (Gate::denies('Update registries')) {

            $this->createAuditTrail("Denied access to  Update registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update registries.']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'registry_code' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'court_type' => ['required', 'integer'],
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
            'courttype_id' => $request->court_type,
            'region_id' => $region,
        ]);

        if ($request->status == 'Move to trash') {

            if (Gate::denies('Delete registries')) {

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


    public function fetchRegistry(Request $request)
    {

        if ($request->wantsJson()) {

            $registries = Registry::fetchRegistry()->where('location_id', $request->location)->get();

            return response()->json($registries);
        }

        abort(404);
    }



    public function assignCategories($slug)
    {
        if (Gate::denies('Assign categories to registries')) {

            $this->createAuditTrail("Denied access to  Assign categories to registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Assign categories to registries.']);
        }

        $registry = Registry::query()->with('categories')->where('slug', $slug)->firstOrfail();

        $categories = Category::query()->where('courttype_id', $registry->courttype_id)->get();

        $this->createAuditTrail('Visited registry categories assignment page.');

        return view('dashboard.registries.assign-categories', compact('registry', 'categories'));
    }

    public function saveCourtCategories(Request $request, $slug)
    {
        if (Gate::denies('Assign categories to registries')) {

            $this->createAuditTrail("Denied access to  Assign categories to registries: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Assign categories to registries.']);
        }

        $registry = Registry::query()->where('slug', $slug)->firstOrfail();

        // Sync the categories
        $registry->categories()->sync($request->categories);

        $total_assigned = !empty($request->categories) ? count($request->categories) : 0;

        $this->createAuditTrail('Assigned ' . $total_assigned . " categories to the registry #" . $registry->name);

        return to_route('registries')->with('success', $total_assigned . ' categories assigned to ' . $registry->name . ' successfully.');
    }

}
