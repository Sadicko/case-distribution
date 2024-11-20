<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Judge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourtJudgeController extends Controller
{
    public function index($slug)
    {
        $court = Court::query()->where('slug', $slug)->firstOrFail();
        $currentJudge = $court->currentJudge->first();
        $judges = Judge::query()->get();

        return view('dashboard.courts.court-judge-assign', compact('court', 'judges', 'currentJudge'));
    }

    public function assignJudge(Request $request, $slug)
    {
        $request->validate([
            'slug' => 'required',
            'judge_id' => 'required|exists:judges,id',
        ]);

        // Mark the current judge as historical
        DB::table('court_judges')
            ->where('slug', $request->slug)
            ->whereNull('unassigned_at')
            ->update(['unassigned_at' => Carbon::now()]);

        // Assign the new judge
        DB::table('court_judges')->insert([
            'court_id' => $request->court_id,
            'judge_id' => $request->judge_id,
            'assigned_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Judge assigned successfully.');
    }


}
