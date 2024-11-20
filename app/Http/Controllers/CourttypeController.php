<?php

namespace App\Http\Controllers;

use App\Models\Courttype;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CourttypeController extends Controller
{
    use AuditTrailLog;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('Manage court type')){

            $this->createAuditTrail("Denied access to  Manage court type: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage court type.']);
        }

        $courttypes =  Courttype::withCount('courts')->get();

        $this->createAuditTrail('Visited courttype list page.');

        return view('dashboard.courttypes.index', compact('courttypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('Create court type')){

            $this->createAuditTrail("Denied access to  Create court type: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create court type.']);
        }

        $this->createAuditTrail('Visited court type creation page.');

        return view('dashboard.courttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Gate::denies('Create court type')){

            $this->createAuditTrail("Denied access to  Create court type: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create court type.']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
        ]);

        $courttype = Courttype::create([
            'slug' => uniqid(),
            'name' => $request->name,
            'code' => $request->code,
            'created_by' => Auth::id(),
        ]);

        $this->createAuditTrail("Created a court type $courttype->name.");

        return redirect()->route('courttypes.index')
        ->with('success', 'Courttype created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {

        if(Gate::denies('Update court type')){

            $this->createAuditTrail("Denied access to  Update court type: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update court type.']);
        }

        $courttype = Courttype::whereslug($slug)->firstOrfail();

        $this->createAuditTrail("Visited court type edit page for $courttype->name.");

        return view('dashboard.courttypes.edit', compact('courttype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        if(Gate::denies('Update court type')){

            $this->createAuditTrail("Denied access to  Update court type: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update court type.']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
        ]);

        $courttype = Courttype::whereslug($slug)->firstOrfail();


        $courttype->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status,
        ]);

        if($request->status == 'Move to trash'){
            if(Gate::denies('Delete court type')){

                $this->createAuditTrail("Denied access to  Delete court type: Unauthorized");

                return back()->with(['error' => 'You are not authorized to Delete court type.']);
            }

            $this->createAuditTrail("Deleted the court type: $courttype->name.");

            $courttype->delete();


            return to_route('courttypes')
            ->with('warning', 'Courttype moved to trash successfully.');
        }   

        $this->createAuditTrail("Update the records for court type: $courttype->name.");

        return back()->with('success', 'Courttype updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
