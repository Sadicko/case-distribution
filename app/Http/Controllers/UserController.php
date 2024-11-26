<?php

namespace App\Http\Controllers;

use App\Events\AccountCreationEvent;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use App\Traits\AuditTrailLog;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    use AuditTrailLog;

    public function showUsers(){

        if(Gate::denies('Manage users')){

            $this->createAuditTrail("Denied access to  Manage users: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage users.']);
        }

        $users = User::latest()->get();

        $this->createAuditTrail('Visited User list page.');

        return view('admin.users.index', compact('users'));
    }

    public function showCreateUserPage(){

        if(Gate::denies('Create users')){

            $this->createAuditTrail("Denied access to  Create users: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create users.']);
        }

        $roles = Role::query()->latest()->get();

        $locations = Location::orderby('name', 'asc')->get();

        $this->createAuditTrail('Visited User creation page.');

        return view('admin.users.create', compact('roles', 'locations'));
    }

    public function saveUser(Request $request){


        if(Gate::denies('Create users')){

            $this->createAuditTrail("Denied access to  Create users: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Create users.']);
        }

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'status' => ['required', 'string', 'max:255'],
            'access_level' => ['required', 'string', 'max:255'],
            'require_password_reset' => ['nullable'],
            'is_expire' => ['nullable'],
            'expire_date' => ['nullable'],
            'location' => ['required', 'integer'],
            'registry' => ['nullable', 'integer'],
        ]);


        if (count(array_diff($request->roles, ["Super Admin", "Administrator", 'Court Manager', 'Director', 'Management'])) > 0 && empty($request->registry)) {
            return back()->withInput()->withErrors(['registry' => 'The registry field is required.']);
        }

        $user = User::query()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => strtolower($request->username),
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'slug' => uniqid(),
            'access_type' => $request->access_level,
            'require_password_reset' => $request->require_password_reset == 'yes' ? 'yes' : 'no',
            'is_expire' => $request->is_expire == 'yes' ? 'yes' : 'no',
            'expire_date' => $request->is_expire == 'yes' ? $request->expire_date : null,
            'invited_by' => Auth::id(),
            'invited_date' => now(),
            'status' => $request->status,
            'location_id' => $request->location,
            'registry_id' => $request->registry,
            'is_approved' => $request->status == 'Active' ? 1 : 0,
        ]);

        $user->syncRoles($request->roles);

        if (getenv('SEND_ACCOUNT_NOTICE_MAIL')){
            event(new AccountCreationEvent($user));
        }

        $this->createAuditTrail("Created a new user account for $user->username.");

        return back()->with("success", "User created successfully and roles assign to user. A verification email has been sent to the user's email.");
    }


    public function showEditUserPage($slug){

        if(Gate::denies('Update users')){

            $this->createAuditTrail("Denied access to  Update users: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update users.']);
        }

        $user = User::whereslug($slug)->firstOrfail();

        $roles = Role::query()->latest()->get();

        $locations = Location::query()->orderby('name', 'asc')->get();

        $this->createAuditTrail("Visited page to edit $user->username.");

        return view('admin.users.edit', compact('user', 'roles', 'locations'));
    }


    public function updateUser(Request $request, $slug){

        if(Gate::denies('Update users')){

            $this->createAuditTrail("Denied access to  Update users: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Update users.']);
        }

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'access_level' => ['required', 'string', 'max:255'],
            'require_password_reset' => ['nullable'],
            'is_expire' => ['nullable'],
            'expire_date' => ['nullable'],
            'location' => ['required', 'integer'],
            'registry' => ['nullable', 'integer'],
        ]);

        if($this->emailExist()){
            return back()->withInput()->withErrors(['email' => 'The email has already been taken.']);
        }

        if($this->userNameExist()){
            return back()->withInput()->withErrors(['username' => 'The username has already been taken.']);
        }

        if($this->phoneExist()){
            return back()->withInput()->withErrors(['phone' => 'The phone has already been taken.']);
        }

        $user = User::whereslug($slug)->firstOrfail();

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => strtolower($request->username),
            'phone' => $request->phone,
            'email' => $request->email,
            'access_type' => $request->access_level,
            'require_password_reset' => $request->require_password_reset == 'yes' ? 'yes' : 'no',
            'is_expire' => $request->is_expire == 'yes' ? 'yes' : 'no',
            'expire_date' => $request->is_expire == 'yes' ? $request->expire_date : null,
            'status' => $request->status,
            'block' => $request->status == 'Active' ? 0 : 1,
            'location_id' => $request->location,
            'registry_id' => $request->registry,
            'is_approved' => $request->status == 'Active' ? 1 : 0,
        ]);

        if($request->require_password_reset == 'yes'){
            $user->update([
                'password' => Hash::make(config('ecds.default_password')),
            ]);

            $this->createAuditTrail("Reset the password for $user->username.");
        }

        $user->syncRoles($request->roles);

        $this->createAuditTrail("Updated records for $user->username.");

        return back()->with('success', 'User updated successfully');
    }

    //determin if phone
    public function  phoneExist()
    {

        return User::where('slug', '!=', request()->slug)
            ->where('phone', request()->phone)
            ->exists();

    }

    //determin if  email exist
    public function emailExist()
    {

        return User::query()->where('slug', '!=', request()->slug)
            ->where('email', request()->email)
            ->exists();

    }

    //determin if  email exist
    public function userNameExist()
    {

        return User::query()->where('slug', '!=', request()->slug)
            ->where('username', request()->username)
            ->exists();

    }
}
