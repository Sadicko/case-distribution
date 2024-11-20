<?php

namespace App\Http\Controllers;

use App\Models\Judge;
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

        $judges = Judge::query()->latest()->get();

        $this->createAuditTrail('Visited judges page.');

        return view('dashboard.judges.index', compact('judges'));
    }
}
