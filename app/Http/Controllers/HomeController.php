<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Bail;
use App\Models\Category;
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

        $judges = 0;// Judge::count();
        $cases = 0; // CaseDetail::count();
        $registered_cases = 0; // CaseDetail::whereNull('disposed_at')->count();
        $disposed_cases = 0; //CaseDetail::whereNotNull('disposed_at')->count();



        $this->createAuditTrail('Visited Dashboard.');

        return view('dashboard.welcome', compact(  'legalYearStart', 'legalYearEnd', 'judges', 'cases', 'registered_cases', 'disposed_cases'));
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
