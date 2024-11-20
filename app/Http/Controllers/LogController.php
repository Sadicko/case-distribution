<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use App\Models\User;
use App\Traits\AuditTrailLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LogController extends Controller
{
    use AuditTrailLog;

    public function index()
    {
        if(Gate::denies('Read logs')){

            $this->createAuditTrail("Denied access to  Read logs: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Read logs.']);
        }

        $users = User::query()->select('id', 'first_name', 'last_name', 'username')->latest()->get();

        $username =  request()->username;

        $period = request()->period ?? (now()->subDays(0)->format('m/d/Y') . ' - ' . now()->format('m/d/Y'));

        $startDate = null;
        $endDate = null;

        if ($period) {
            list($startDate, $endDate) = explode(' - ', $period);
            $startDate = Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay();
        }

        $query = AuditTrail::query();

        if ($username) {
            $query->where('username', 'like', '%' . $username . '%');
        }

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $audits = $query->latest()->get();


        return view('dashboard.logs.index', compact('users', 'audits'));

    }
}
