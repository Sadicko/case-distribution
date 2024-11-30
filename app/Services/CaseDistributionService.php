<?php

namespace App\Services;

use App\Models\Allocation;
use App\Models\Court;

class CaseDistributionService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function assignCase($docket)
    {
        // Step 1: Fetch all eligible courts
        $eligibleCourts = Court::query()
            ->with('currentJudge')
            ->where('location_id', $docket->location_id) // Restrict to docket's location
            ->where('availability', 1) // Ensure court is available
            ->whereHas('categories', function ($query) use ($docket) {
                $query->where('categories.id', $docket->category_id); // Match the case category
            })
            ->whereHas('currentJudge')
            ->get();

        if ($eligibleCourts->isEmpty()) {
            //submit for manuel assignment
            $docket->assign_type = 'manuel';
            $docket->save();

            throw new \Exception('No eligible courts available for this case.');
        }

        // Step 2: Calculate weights for weighted randomization
        $maxCaseCount = $eligibleCourts->max('case_count') + 1;
        $eligibleCourts->transform(function ($court) use ($maxCaseCount) {
            $court->weight = $maxCaseCount - $court->case_count + 1; // Calculate weight
            return $court;
        });

        // Step 3: Handle priority cases
        if ($docket->priority_level === 'urgent') {
            // Narrow down to courts with the minimum case count
            $minCaseCount = $eligibleCourts->min('case_count');
            $eligibleCourts = $eligibleCourts->filter(function ($court) use ($minCaseCount) {
                return $court->case_count === $minCaseCount;
            });
        }

        // Step 4: Perform weighted randomization
        $selectedCourt = $this->selectCourtByWeight($eligibleCourts);

        // Step 5: Update court workload and log assignment
        $selectedCourt->increment('case_count');

        // Step 6: Assign court and judge to docket
        $docket->court_id = $selectedCourt->id;
        $docket->judge_id = $selectedCourt->currentJudge[0]->id;
        $docket->assigned_date = now();
        $docket->is_assigned = 1;
        $docket->status = 'Assigned';
        $docket->save();

        Allocation::query()->create([
            'docket_id' => $docket->id,
            'court_id' => $docket->court_id,
            'judge_id' => $docket->judge_id,
            'assigned_by' => $docket->created_by,
            'assignment_reason' => 'New',
            'date_assigned' => $docket->assigned_date,
        ]);

        return $selectedCourt;
    }

    /**
     * Select a court using weighted randomization.
     *
     * @param \Illuminate\Support\Collection $eligibleCourts
     * @return \App\Models\Court
     */
    protected function selectCourtByWeight($eligibleCourts)
    {
        $totalWeight = $eligibleCourts->sum('weight');
        $randomWeight = random_int(1, $totalWeight);

        foreach ($eligibleCourts as $court) {
            $randomWeight -= $court->weight;
            if ($randomWeight <= 0) {
                return $court;
            }
        }

        throw new \Exception('Weighted randomization failed.');
    }


//    public function assignCase($docket)
//    {
//        // Step 1: Fetch all eligible courts
//        $eligibleCourts = Court::query()->where('location_id', $docket->location_id)
//            ->where('availability', 1)
//            ->whereHas('categories', function ($query) use ($docket) {
//                $query->where('categories.id', $docket->category_id);
//            })
//            ->orderBy('case_count', 'asc') // Sort by workload
//            ->get();
//
//        if ($eligibleCourts->isEmpty()) {
//            throw new \Exception('No eligible courts available for this case.');
//        }
//
//        // Step 2: Handle priority cases
//        if ($docket->priority_level === 'urgent') {
//            $urgentCourts = $eligibleCourts->where('case_count', $eligibleCourts->min('case_count'));
//        } else {
//            $urgentCourts = $eligibleCourts;
//        }
//
//        // Step 3: Randomize selection among the least busy courts
//        $leastBusyCourts = $urgentCourts->filter(function ($court) use ($urgentCourts) {
//            return $court->case_count === $urgentCourts->first()->case_count;
//        });
//
//        $selectedCourt = $leastBusyCourts->random();
//
//        // Step 4: Update court workload and log assignment
//        $selectedCourt->increment('case_count');
//
//        // Step 5: Assign court to docket
//        $docket->court_id = $selectedCourt->id;
//        $docket->assigned_date = now();
//        $docket->is_assigned = 1;
//        $docket->save();
//
//        return $selectedCourt;
//    }
}
