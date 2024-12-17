<?php

namespace App\Http\Controllers;

use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    use AuditTrailLog;
     public function showWorkflow()
    {
           // Get the current date
        $currentDate = legalYear()['currentDate'];
        $currentYear = legalYear()['currentYear'];
        $legalYearStart = legalYear()['legalYearStart'];
        $legalYearEnd = legalYear()['legalYearEnd'];

//        $bails = Bail::with(['sureties' => function($query){
//            $query->whereNull('document_verified_at');
//        }])->whereHas('sureties', function($query) {
//            $query->whereNull('document_verified_at');
//        })->get();
//
//
//        $pendingBails = Bail::getBail()->whereHas('sureties', function($query) {
//            $query->whereNotNull('document_verified_at');
//        })->where('status', 'Pending')->get();

         $dockets = collect([]);


        $this->createAuditTrail('Visited workflow page.');

        return view('dashboard.workflow', compact('legalYearStart', 'legalYearEnd', 'dockets'));
    }
}
