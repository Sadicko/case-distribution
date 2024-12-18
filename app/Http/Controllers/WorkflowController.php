<?php

namespace App\Http\Controllers;

use App\Models\CaseReassignment;
use App\Models\Docket;
use App\Traits\AuditTrailLog;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
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

        //get user
        $user = Auth::user();

        if (Gate::any(['Approve step one', 'Approve step two', 'Approve step three']) && !$user->hasRole('Super Admin')) {
            $dockets = CaseReassignment::query()->with('dockets', 'dockets.categories', 'categories')->withWhereHas('approvals', function ($query) use ($user) {
                $query->where('approved_by', $user->id);
            })->where('status', 'pending')->get();
        } else {
            $dockets = CaseReassignment::query()->with('dockets', 'dockets.categories', 'categories')->where('status', 'pending')->get();
        }

        $case_counts = collect([]);

        $this->createAuditTrail('Visited workflow page.');

        return view('dashboard.workflow', compact('legalYearStart', 'legalYearEnd', 'dockets', 'case_counts', 'user'));
    }
}
