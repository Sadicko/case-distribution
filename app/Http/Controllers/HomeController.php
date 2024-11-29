<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Docket;
use App\Models\Judge;
use App\Traits\AuditTrailLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use AuditTrailLog;

    public function index()
    {
        // legal Year

        // Get the current date
        $currentDate = legalYear()['currentDate'];
        $currentYear = legalYear()['currentYear'];
        $legalYearStart = legalYear()['legalYearStart'];
        $legalYearEnd = legalYear()['legalYearEnd'];

        $cases = Docket::getDockets()->whereBetween('assigned_date', [$legalYearStart, $legalYearEnd])->count();
        $casesAllocated = Docket::getDockets()->where('status', 'Assigned')->whereBetween('assigned_date', [$legalYearStart, $legalYearEnd])->count();
        $casesNotAllocated = Docket::getDockets()->where('status', 'Filed')->whereBetween('assigned_date', [$legalYearStart, $legalYearEnd])->count();
        $casesAutoAllocated = Docket::getDockets()->where('assign_type', 'auto')->whereBetween('assigned_date', [$legalYearStart, $legalYearEnd])->count();
        $manualCasesAllocated = Docket::getDockets()->where('assign_type', 'manual')->whereBetween('assigned_date', [$legalYearStart, $legalYearEnd])->count();
        $disposed_cases = Docket::getDockets()->whereNotNull('disposed_at')->whereBetween('disposed_at', [$legalYearStart, $legalYearEnd])->count();
        $judges = Judge::query()->count();

        if (Gate::any(['court_staff', 'judge'])){
            $dockets = Docket::getDockets()->with('categories', 'courts', 'courts.currentJudge')
                ->whereBetween('assigned_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get();
        }else{
            $dockets = collect([]);
        }


        $this->createAuditTrail('Visited Dashboard.');

        return view('dashboard.welcome', compact(  'legalYearStart', 'legalYearEnd', 'judges', 'cases', 'casesAllocated', 'casesNotAllocated', 'manualCasesAllocated', 'casesAutoAllocated', 'disposed_cases', 'dockets'));
    }

}
