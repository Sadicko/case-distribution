<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Courttype;
use App\Models\Judge;
use App\Models\Location;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JudgeController extends Controller
{
    use AuditTrailLog;

    public function index()
    {
        if(Gate::denies('Manage judges')){

            $this->createAuditTrail("Denied access to  Manage judges: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage judges.']);
        }

        $judges = Judge::query()->with('currentCourt', 'currentCourt.locations')->latest()->get();

        $this->createAuditTrail('Visited judges page.');

        return view('dashboard.judges.index', compact('judges'));
    }

    public function create()
    {
        if(Gate::denies('Create judges')){

            $this->createAuditTrail("Denied access to  Create judges: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create judges.']);
        }

        $courttypes = Courttype::query()->where('status', '!=', 'Archived')->get();
//        $locations = Location::query()->where('status', '!=', 'Archived')->get();

        $this->createAuditTrail('Visited judges creation page.');

        return view('dashboard.judges.create', compact('courttypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:judges,name',
            'courttype' => 'required|integer',
            'status' => 'required|string',
        ]);

        $judge = Judge::query()->create([
            'slug' => uniqid(),
            'name' => strtoupper($request->get('name')),
            'status' => $request->get('status'),
            'courttype_id' => $request->get('courttype'),
        ]);

        $this->createAuditTrail('Created a new judge #'.$judge->name);

        return back()->with('success', 'Judge created successfully.');
    }

    public function edit($slug)
    {
        if(Gate::denies('Update judges')){

            $this->createAuditTrail("Denied access to  Update judges: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update judges.']);
        }

        $judge = Judge::query()->where('slug', $slug)->firstOrFail();
        $courttypes = Courttype::query()->where('status', '!=', 'Archived')->get();

        $this->createAuditTrail('Visited edit page for #'.$judge->name);

        return view('dashboard.judges.edit', compact('judge', 'courttypes'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'courttype' => 'required|integer',
            'status' => 'required|string',
        ]);

        if ($this->judgeNameExist()) {
            return back()->withInput()->withErrors(['name' => 'The judge name already exist.']);
        }

        $judge = Judge::query()->where('slug', $request->slug)->firstOrFail();
        $judge->update([
            'name' => strtoupper($request->get('name')),
            'status' => $request->get('status'),
            'courttype_id' => $request->get('courttype'),
            'availability' => $request->get('availability') ? 1 : 0,
        ]);

        $this->createAuditTrail('Updated records of the judge #'.$judge->name);

        return back()->with('success', 'Judge records updated successfully.');
    }

    // determine name exist
    public function  judgeNameExist()
    {
        return Judge::query()->where('slug', '!=', request()->slug)->where('name', request()->court_name)->first();
    }
}
