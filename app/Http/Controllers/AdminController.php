<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Courtruling;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AuditTrailLog;

    public function index(){

        $users =  User::count();
        $admins =  User::where('access_level', 'Super')->count();
        $expiring_users =  User::where('is_expire', 'yes')->count();
        $cases =  Courtruling::count();
        $roles =  Role::count();
        $permissions =  Permission::count();

        $this->createAuditTrail("Admin dashboard.");

        return view('admin.index', compact('users', 'cases', 'roles', 'permissions', 'admins', 'expiring_users'));
    }

    public function showMessages(){

        $messages = Contact::latest()->get();

        $this->createAuditTrail("Visited contact messages page");

        return view('admin.contacts.index', compact('messages'));
    }

    public function messageDetails($slug){

        $contact = Contact::whereSlug($slug)->firstOrfail();

        $this->createAuditTrail("Read the message.");

        return view('admin.contacts.show', compact('contact'));
    }
}
