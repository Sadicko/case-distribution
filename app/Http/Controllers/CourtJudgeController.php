<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Judge;
use App\Traits\AuditTrailLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CourtJudgeController extends Controller
{
    use AuditTrailLog;
    public function index($slug)
    {
        if(Gate::denies('Assign court judges')){

            $this->createAuditTrail("Denied access to  Assign court judges: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Assign court judges.']);
        }

        $court = Court::query()->where('slug', $slug)->firstOrFail();
        $currentJudge = $court->currentJudge->first();
        $judges = Judge::query()->whereDoesntHave('courts')->where('courttype_id', $court->courttype_id)->get();


        $this->createAuditTrail('Visited court - judge assign page');

        return view('dashboard.courts.court-judge-assign', compact('court', 'judges', 'currentJudge'));
    }

    public function assignJudge(Request $request, $slug)
    {
        if(Gate::denies('Assign court judges')){

            $this->createAuditTrail("Denied access to  Assign court judges: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Assign court judges.']);
        }

        $request->validate([
            'court' => 'required',
            'judge' => 'required|exists:judges,id',
        ]);

        // Mark the current judge as historical
        DB::table('court_judges')
            ->where('id', $request->court)
            ->whereNull('unassigned_at')
            ->update(['unassigned_at' => Carbon::now()]);

        // Assign the new judge
        DB::table('court_judges')->insert([
            'slug' => uniqid(),
            'court_id' => $request->court,
            'judge_id' => $request->judge,
            'assigned_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => Auth::id(),
        ]);

        $court = Court::query()->find($request->court);
        $judge = Judge::query()->find($request->judge);

        $this->createAuditTrail('Assigned the judge #'.$judge->name.' to the court #'.$court->name);

        return redirect()->back()->with('success', 'Judge assigned successfully.');
    }


}
