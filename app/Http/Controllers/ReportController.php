<?php

namespace App\Http\Controllers;

use App\Traits\AuditTrailLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    use AuditTrailLog;


    public function caseLoadByRegistry()
    {

        if (Gate::denies('Read reports')) {

            $this->createAuditTrail("Denied access to  Read reports: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Read reports.']);
        }

        // Get the current date
        $currentDate = legalYear()['currentDate'];
        $currentYear = legalYear()['currentYear'];
        // $legalYearStart = legalYear()['legalYearStart'];
        // $legalYearEnd = legalYear()['legalYearEnd'];
        // Get the current date
        $today = Carbon::today();
        $legalYearStart = $today->copy()->startOfWeek(Carbon::MONDAY);
        $legalYearEnd = $legalYearStart->copy()->addDays(4); // Monday + 4 days = Friday

        $this->createAuditTrail("Visited report page: Case load by registries.");

        return view("dashboard.reports.by-registries", compact("legalYearStart", "legalYearEnd"));
    }


    public function caseLoadByCourts()
    {
        if (Gate::denies('Read reports')) {

            $this->createAuditTrail("Denied access to  Read reports: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Read reports.']);
        }

        // Get the current date
        $currentDate = legalYear()['currentDate'];
        $currentYear = legalYear()['currentYear'];
        // $legalYearStart = legalYear()['legalYearStart'];
        // $legalYearEnd = legalYear()['legalYearEnd'];
        // Get the current date
        $today = Carbon::today();
        $legalYearStart = $today->copy()->startOfWeek(Carbon::MONDAY);
        $legalYearEnd = $legalYearStart->copy()->addDays(4); // Monday + 4 days = Friday

        $this->createAuditTrail("Visited report page: Case load by courts.");

        return view("dashboard.reports.by-courts", compact("legalYearStart", "legalYearEnd"));
    }


    public function index(Request $request)
    {
        if (Gate::denies('Read reports')) {

            $this->createAuditTrail("Denied access to  Read reports: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Read reports.']);
        }


        $q = $request->q;
        // Get the current date
        $currentDate = legalYear()['currentDate'];
        $currentYear = legalYear()['currentYear'];
        $legalYearStart = legalYear()['legalYearStart'];
        $legalYearEnd = legalYear()['legalYearEnd'];


        switch ($q) {
            case "by-courts":
                $view = "by-courts";
                $title = "Reports by courts";
                break;

            case "by-registries":
                $view = "by-registries";
                $title = "Reports by registries";
                break;

            case "by-region":
                $view = "by-regions";
                $title = "Reports by regions";
                break;

            case "by-bail-type":
                $view = "by-bail-type";
                $title = "Reports by bail-types";
                break;

            default:
                $view = "index";
                $title = "Reports by status";
                break;
        }

        $this->createAuditTrail("Visited report page.");

        return view("dashboard.reports.$view", compact("legalYearStart", "legalYearEnd", 'title'));
    }
}
