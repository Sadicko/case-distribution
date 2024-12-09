<?php

namespace App\Livewire;

use App\Models\Docket;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

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
                if (config('database.default') == 'mysql') {
                    $assignment = Docket::getDockets()
                        ->selectRaw('MONTHNAME(assigned_date) as period, MONTH(assigned_date) as month_num, COUNT(*) as case_count')
                        ->whereBetween('assigned_date', [$legalYearStart, $legalYearEnd])
                        ->groupByRaw('MONTH(assigned_date), MONTHNAME(assigned_date)')
                        ->orderByRaw('month_num ASC')
                        ->get()
                        ->toArray();
                } else {
                    $assignment = Docket::getDockets()
                        ->selectRaw("DATENAME(month, assigned_date) as period, COUNT(*) as case_count")
                        ->whereBetween('assigned_date', [$legalYearStart, $legalYearEnd])
                        ->groupByRaw("MONTH(assigned_date)")
                        ->orderByRaw("MONTH(assigned_date) ASC")
                        ->get()->toArray();
                }
                break;

            case 'yearly':

                if (config('database.default') == 'mysql') {
                    $assignment = Docket::getDockets()
                        ->selectRaw('YEAR(assigned_date) as period, COUNT(*) as case_count')
                        ->whereYear('assigned_date', '>', now()->subYears(5)->year)
                        ->groupByRaw('YEAR(assigned_date)')
                        ->orderByRaw('YEAR(assigned_date) ASC')
                        ->get()->toArray();
                } else {
                    $assignment = Docket::getDockets()
                        ->selectRaw("FORMAT(assigned_date, 'yyyy') as period, COUNT(*) as case_count")
                        ->whereRaw("YEAR(assigned_date) > ?", [now()->subYears(5)->year])
                        ->groupByRaw("FORMAT(assigned_date, 'yyyy')")
                        ->orderByRaw("FORMAT(assigned_date, 'yyyy') ASC")
                        ->get()->toArray();
                }

                break;

            default:
                // Weekly data as default
                $day1 = Carbon::parse('last monday')->startOfDay();
                $day2 = Carbon::parse('next friday')->endOfDay();

                if (config('database.default') == 'mysql') {
                    $assignment = Docket::getDockets()
                        ->selectRaw('DATE_FORMAT(assigned_date, "%d-%m-%Y") as period, COUNT(*) as case_count')
                        ->whereBetween('assigned_date', [$day1, $day2])
                        ->groupByRaw('DATE_FORMAT(assigned_date, "%d-%m-%Y")')
                        ->orderByRaw('DATE_FORMAT(assigned_date, "%d-%m-%Y") ASC')
                        ->get()->toArray();
                } else {
                    $assignment = Docket::getDockets()
                        ->selectRaw("FORMAT(assigned_date, 'dd-MM-yyyy') as period, COUNT(*) as case_count")
                        ->whereBetween('assigned_date', [$day1, $day2])
                        ->groupByRaw("FORMAT(assigned_date, 'dd-MM-yyyy')")
                        ->orderByRaw("FORMAT(assigned_date, 'dd-MM-yyyy') ASC")
                        ->get()->toArray();
                }
                break;
        }



        $this->caseDistributions = $assignment;

        // dispatch event to the frontend
        $this->dispatch('caseDistributionsUpdated', ['caseDistributions' => $this->caseDistributions, 'status' => $this->status]);
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
