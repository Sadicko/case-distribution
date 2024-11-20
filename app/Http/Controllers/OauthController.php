<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OauthController extends Controller
{
    public function loginUser(Request $request)
    {
        // return $request;
        $user = json_decode($request->data);

        $active_user = User::where('username', $user->username)->first();

        if ($active_user) {

            if (Auth::check()) {

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

            }

            Auth::login($active_user);

        }else{

            if (Auth::check()) {

                Auth::logout();
                
                $request->session()->invalidate();

                $request->session()->regenerateToken();

            }
            

            $active_user = User::create([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'username' => strtolower($user->username),
                'phone' => $user->phone_number,
                'email' => $user->email,
                'password' => Hash::make('1234@abcd'),
                'slug' => $user->slug,
                'access_type' => $request->access_level ?? 'General Admin',
                'require_password_reset' => $request->require_password_reset == 'yes' ? 'yes' : 'no',
                'is_expire' => $request->is_expire == 'yes' ? 'yes' : 'no',
                'expire_date' => $request->is_expire == 'yes' ? $request->expire_date : null,
                'status' => $user->status,
                'location_id' => 1,
                'registry_id' => $user->registry ?? null,
                'is_approved' => $user->status == 'Active' ? 1 : 0,
            ]);

            $active_user->syncRoles('Administrator');

            Auth::login($active_user);

        }

        return to_route('dashboard');

    }
}
