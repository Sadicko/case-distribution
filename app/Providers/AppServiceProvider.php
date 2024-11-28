<?php

namespace App\Providers;

use App\Listeners\LoginListener;
use App\Listeners\LogoutListener;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //pagination
        Paginator::useBootstrapFive();
        //Events
        Event::listen(
            Login::class,
            LoginListener::class,
        );
        Event::listen(
            Logout::class,
            LogoutListener::class,
        );


        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        // Should return TRUE or FALSE if system admin
        Gate::define('manage_system', function(User $user) {
            return $user->access_type === "System Admin";
        });

        // Should return TRUE or FALSE if General administration
        Gate::define('general_admin', function(User $user) {
            return $user->access_type === "General Admin";
        });

        // Should return TRUE or FALSE if Registrar
        Gate::define('developer_user', function(User $user) {
            return $user->access_type === "Developer";
        });

        // Should return TRUE or FALSE if Registrar
        Gate::define('management_admin', function(User $user) {
            return $user->access_type === "Management";
        });

        // Should return TRUE or FALSE if Registrar
        Gate::define('court_registrar', function(User $user) {
            return $user->access_type === "Registrar";
        });

        // Should return TRUE or FALSE if Director
        Gate::define('director', function(User $user) {
            return $user->access_type === "Director";
        });

        // Should return TRUE or FALSE if Registrar
        Gate::define('court_manager', function(User $user) {
            return $user->access_type === "Court Manager";
        });

        // Should return TRUE or FALSE if Court Staff
        Gate::define('court_staff', function(User $user) {
            return $user->access_type === "Court Staff";
        });

        // Should return TRUE or FALSE if Filing Staff
        Gate::define('filing_clerk', function(User $user) {
            return $user->access_type === "Filing Clerk";
        });

        // Should return TRUE or FALSE if Process clerk
        Gate::define('process_clerk', function(User $user) {
            return $user->access_type === "Process Clerk";
        });

        // Should return TRUE or FALSE if Process clerk
        Gate::define('docket_clerk', function(User $user) {
            return $user->access_type === "Docket Clerk";
        });

        // Should return TRUE or FALSE if Judge
        Gate::define('judge', function(User $user) {
            return $user->access_type === "Judge";
        });

    }
}
