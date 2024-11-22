<?php

namespace App\Services;

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
        $eligibleCourts = Court::query()->where('location_id', $docket->location_id)
            ->where('availability', 1)
            ->whereHas('categories', function ($query) use ($docket) {
                $query->where('categories.id', $docket->category_id);
            })
            ->orderBy('case_count', 'asc') // Sort by workload
            ->get();

        if ($eligibleCourts->isEmpty()) {
            throw new \Exception('No eligible courts available for this case.');
        }

        // Step 2: Handle priority cases
        if ($docket->priority_level === 'urgent') {
            $urgentCourts = $eligibleCourts->where('case_count', $eligibleCourts->min('case_count'));
        } else {
            $urgentCourts = $eligibleCourts;
        }

        // Step 3: Randomize selection among the least busy courts
        $leastBusyCourts = $urgentCourts->filter(function ($court) use ($urgentCourts) {
            return $court->case_count === $urgentCourts->first()->case_count;
        });

        $selectedCourt = $leastBusyCourts->random();

        // Step 4: Update court workload and log assignment
        $selectedCourt->increment('case_count');

        // Step 5: Assign court to docket
        $docket->court_id = $selectedCourt->id;
        $docket->assigned_date = now();
        $docket->is_assigned = 1;
        $docket->save();

        return $selectedCourt;
    }
}
