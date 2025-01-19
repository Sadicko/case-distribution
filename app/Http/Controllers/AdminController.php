<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Docket;
use App\Models\Judge;
use App\Models\Role;
use App\Models\User;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    use AuditTrailLog;

    public function index(){

        if(Gate::denies('Manage admin metrics')){

            $this->createAuditTrail("Denied access to  Manage admin metrics: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage admin metrics.']);
        }

        $users =  User::query()->count();
        $admins =  User::query()->where('access_type', 'Super Admin')->count();
        $totalCourtUsers =  User::query()->whereNotNull('court_id')->count();
        $totalRegistryUsers =  User::query()->whereNotNull('registry_id')->whereNull('court_id')->count();
        $expiring_users =  User::query()->where('is_expire', 'yes')->count();
        $totalDockets =  Docket::query()->count();
        $totalCourts =  Court::query()->count();
        $totalJudges =  Judge::query()->count();
        $roles =  Role::query()->count();
        $permissions =  Permission::query()->count();

        $this->createAuditTrail("Visited Admin dashboard.");

        return view('admin.index', compact('users', 'totalCourtUsers', 'totalRegistryUsers', 'totalDockets', 'totalCourts', 'totalJudges', 'roles', 'permissions', 'admins', 'expiring_users'));
    }
}
