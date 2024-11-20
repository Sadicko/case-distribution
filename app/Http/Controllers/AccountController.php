<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class AccountController extends Controller
{
    use AuditTrailLog;


    public function showPasswordResetPage(){

        $this->createAuditTrail('Visited Password reset page.');

        return view('auth.reset-password');
    }

    public function resetNewPassword(Request $request){


        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', Rules\Password::defaults(),  Rule::notIn(['1234@abcd', '12345678'])],
        ]);


        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->new_password),
            'require_password_reset' => 'no',
            'accepted_date' => now(),
            'accepted' => 1,
        ]);

        $this->createAuditTrail('Account password was reset.');

        return to_route('dashboard')->with('info', "Account reset successful");
    }
}
