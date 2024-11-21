<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    use AuditTrailLog;

    public function index(){

        if(Gate::denies('Manage roles')){

            $this->createAuditTrail("Denied access to  Manage roles: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage roles.']);
        }

        $roles =  Role::withCount(['permissions', 'users'])
            ->whereNot('name', 'Super Admin')->latest()
            ->latest()
            ->get();

        $this->createAuditTrail('Visited role list page.');

        return view('admin.roles.index', compact('roles'));
    }

    public function create($slug = null){

        if(Gate::denies('Create roles') || Gate::denies('Update roles')){

            $this->createAuditTrail("Denied access to  Create/Update roles: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create/Update roles.']);
        }


        if(!empty($slug)){
            $role =  Role::whereSlug($slug)->firstOrfail();
        }else{
            $role = null;
        }

        $this->createAuditTrail('Visited role creation page.');

        return view('admin.roles.create', compact('role'));
    }

    public function  store(Request $request)
    {

        if(Gate::denies('Create roles') || Gate::denies('Update roles')){

            $this->createAuditTrail("Denied access to  Create/Update roles: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create/Update roles.']);
        }


        $request->validate([
            'role_name' => ['required', 'string', 'max:250'],
            'status' => ['required', 'string', 'max:250'],
        ]);
        // return if role exist
        if($this->roleExist()) {
            return back()->with('error', 'Role name already taken.');
        }

        $role =  Role::updateOrcreate(
            [
                'slug'      => request()->slug ?? str_shuffle(strtotime(now())),
            ],
            [
                'name' => $request->role_name,
                'guard_name' => 'web',
                'status' => $request->status,
            ]
        );


        if (empty($request->slug) ) {
            $this->createAuditTrail("Created a new role $role->name.");

            return to_route('admin.roles.assign', $role->slug)->with('success', 'Role created successfully. Assign permissions to this role');
        }else{

            $this->createAuditTrail("Updated the role: $role->name");

            return back()->with('success', 'Role updated successfully.');
        }

    }

    public function roleExist()
    {
        return Role::where([
            'name' => request()->role_name,
        ])->where('slug', '!=' , request()->slug)
            ->first();
    }

    public function  showAssignPermissionsPage(Request $request, $slug)
    {
        $role =  Role::whereSlug($slug)->firstOrfail();

        $modules = Module::with('permissions')->get();

        $this->createAuditTrail("Visted permissions assignment page to assign permisions to the role $role->name");

        return view('admin.roles.assign-permissions', compact('role', 'modules'));

    }

    public function  assignPermissions(Request $request, $slug){

        $role =  Role::whereSlug($slug)->firstOrfail();


        $role->syncPermissions($request->permissions);

        $this->createAuditTrail("Assigned ".count($request->permissions)." permisions to the role $role->name");

        return to_route('admin.roles')->with('success', 'Permissions assigned to role successfully');
    }
}
