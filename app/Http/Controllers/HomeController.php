<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Bail;
use App\Models\Category;
use App\Models\Docket;
use App\Models\Judge;
use App\Models\Region;
use App\Traits\AuditTrailLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $cases = Docket::getDockets()->whereBetween('date_filed', [$legalYearStart, $legalYearEnd])->count();
        $casesAllocated = Docket::getDockets()->where('status', 'Assigned')->whereBetween('date_filed', [$legalYearStart, $legalYearEnd])->count();
        $casesNotAllocated = Docket::getDockets()->where('status', 'Filed')->whereBetween('date_filed', [$legalYearStart, $legalYearEnd])->count();
        $casesAutoAllocated = Docket::getDockets()->where('assign_type', 'auto')->whereBetween('date_filed', [$legalYearStart, $legalYearEnd])->count();
        $manualCasesAllocated = Docket::getDockets()->where('assign_type', 'auto')->whereBetween('date_filed', [$legalYearStart, $legalYearEnd])->count();
        $disposed_cases = Docket::getDockets()->whereNotNull('disposed_at')->whereBetween('disposed_at', [$legalYearStart, $legalYearEnd])->count();
        $judges = Judge::query()->count();



        $this->createAuditTrail('Visited Dashboard.');

        return view('dashboard.welcome', compact(  'legalYearStart', 'legalYearEnd', 'judges', 'cases', 'casesAllocated', 'casesNotAllocated', 'manualCasesAllocated', 'casesAutoAllocated', 'disposed_cases'));
    }


    public function showWorkflow()
    {
        // Get the current date
        $currentDate = legalYear()['currentDate'];
        $currentYear = legalYear()['currentYear'];
        $legalYearStart = legalYear()['legalYearStart'];
        $legalYearEnd = legalYear()['legalYearEnd'];

        $bails = Bail::with(['sureties' => function($query){
            $query->whereNull('document_verified_at');
        }])->whereHas('sureties', function($query) {
            $query->whereNull('document_verified_at');
        })->get();


        $pendingBails = Bail::getBail()->whereHas('sureties', function($query) {
            $query->whereNotNull('document_verified_at');
        })->where('status', 'Pending')->get();


        $this->createAuditTrail('Visited workflow page.');

        return view('dashboard.workflow', compact('legalYearStart', 'legalYearEnd', 'pendingBails', 'bails'));
    }
}
