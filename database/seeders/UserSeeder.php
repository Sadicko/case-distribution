<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            'first_name' => 'ECDS',
            'last_name' => 'Admin',
            'username' => 'admin.ecds',
            'email' => 'info@ecds.gov.gh',
            'phone' => '0200000000',
            'email_verified_at' => now(),
            'status' => 'Active',
            'accepted' => 1,
            'accepted_date' => now(),
            'created_at' => now(),
            'access_type' => 'Super Admin',
            'is_approved' => 1,
            'approved_at' => now(),
            'password' => Hash::make('1234@abcd'),
            'remember_token' => Str::random(10),
            'slug' => uniqid(),
        ];

        DB::table('users')->insert($users);


        // assign roles
        $user = User::query()->first();

        $user->assignRole('Super Admin');
    }
}
