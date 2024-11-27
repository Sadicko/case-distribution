<?php

namespace App\Livewire;

use App\Models\Docket;
use Carbon\Carbon;
use Livewire\Component;

class DashboardChart extends Component
{

    public $caseDistributions = [];
    public $status = 'weekly'; // Default status

    // Method to fetch case distributions
    public function getCaseDistributions($status = "weekly")
    {

        sleep(1);

        // If status is passed, update it; otherwise, use the default (weekly)
        $this->status = $status ?? $this->status;
        $legalYearStart = legalYear()['legalYearStart'];
        $legalYearEnd = legalYear()['legalYearEnd'];

        switch ($this->status) {
            case 'monthly':
                if (getenv('DB_CONNECTION') == 'mysql') {
                    $assignment = Docket::query()
                        ->selectRaw('monthname(assigned_date) period, count(*) as case_count')
                        ->groupBy('period')
                        ->whereBetween('date_filed', [$legalYearStart, $legalYearEnd])
                        ->orderBy('period', 'desc')
                        ->get()->toArray();
                } else {
                    $assignment = Docket::query()
                        ->selectRaw("datename(month, assigned_date) as period, count(*) as case_count")
                        ->whereBetween('date_filed', [$legalYearStart, $legalYearEnd])
                        ->groupByRaw("datename(month, assigned_date)")
                        ->orderByRaw("datename(month, assigned_date) DESC")
                        ->get()->toArray();
                }
                break;

            case 'yearly':
                if (getenv('DB_CONNECTION') == 'mysql') {
                    $assignment = Docket::query()
                        ->selectRaw('DATE_FORMAT(assigned_date, "%Y") period, count(*) as case_count')
                        ->groupBy('period')
                        ->whereYear('assigned_date', '>', now()->subYears(5))
                        ->orderBy('period', 'asc')
                        ->get()->toArray();
                } else {
                    $assignment = Docket::query()
                        ->selectRaw("FORMAT(assigned_date, 'yyyy') as period, count(*) as case_count")
                        ->whereYear('assigned_date', '>', now()->subYears(5)->format('Y'))
                        ->groupByRaw("FORMAT(assigned_date, 'yyyy')")
                        ->orderByRaw("FORMAT(assigned_date, 'yyyy') ASC")
                        ->get()->toArray();
                }
                break;

            default:
                // Weekly data as default
                $day1 = Carbon::parse('last monday')->startOfDay();
                $day2 = Carbon::parse('next friday')->endOfDay();

                if (getenv('DB_CONNECTION') == 'mysql') {
                    $assignment = Docket::query()
                        ->selectRaw('DATE_FORMAT(assigned_date, "%d-%m-%Y") as period, count(*) as case_count')
                        ->whereBetween('assigned_date', [$day1, $day2])
                        ->groupBy('period')
                        ->orderBy('period', 'desc')
                        ->get()->toArray();
                } else {
                    $assignment = Docket::query()
                        ->selectRaw("CONVERT(varchar, assigned_date, 105) as period, count(*) as case_count")
                        ->whereBetween('assigned_date', [$day1, $day2])
                        ->groupByRaw("CONVERT(varchar, assigned_date, 105)")
                        ->orderByRaw("CONVERT(varchar, assigned_date, 105) DESC")
                        ->get()->toArray();
                }
                break;
        }

        $this->caseDistributions = $assignment;

        // Emit event to the frontend
        $this->dispatch('caseDistributionsUpdated', ['caseDistributions' => $this->caseDistributions, 'status' => $this->status] );
    }

    // Fetch data when component mounts
    public function mount()
    {
        $this->getCaseDistributions(); // Fetch weekly data on page load
    }

    public function render()
    {
        return view('livewire.dashboard-chart');
    }
}
