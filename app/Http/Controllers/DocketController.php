<?php

namespace App\Http\Controllers;

use App\Models\Docket;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;

class DocketController extends Controller
{
    use AuditTrailLog;
    public function showCases()
    {
        // create audit
        $this->createAuditTrail('Visited cases page.');

        return view('dashboard.dockets.index');
    }

}
