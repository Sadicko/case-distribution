<?php

namespace App\Jobs;

use App\Services\CaseDistributionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ProcessCasesJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue;

    protected $dockets;
    protected $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($dockets,  $userId)
    {
        $this->dockets = $dockets;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(CaseDistributionService $caseDistributionService): void
    {
        $this->dockets->chunk(100)->each(function ($chunk) use ($caseDistributionService) {
            foreach ($chunk as $docket) {


                try {

                    $caseDistributionService->assignCase($docket, $this->userId);
                } catch (\Exception $e) {
                    // Handle errors
                    //submit for manuel assignment
                    $docket->assign_type = 'manuel';
                    $docket->save();

                    Log::info("The error below occurred and there for submitted for manual assignment: " . $e->getMessage());
                }
            }
        });
    }
}
