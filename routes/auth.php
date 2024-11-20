<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\OauthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    // ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // custom login
    Route::get('auth/sso/login', [OauthController::class, 'loginUser']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    // ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    // ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    // ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    // ->name('password.store');


    // jOuath login
    Route::get('/auth/sso', function (Request $request) {
        $request->session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => getenv('JOAUTH_CLIENT_ID'),
            'redirect_uri' => config('app.url').'/callback',
            'response_type' => 'code',
            'scope' => '*',
            'state' => $state,
            // "none", "consent", or "login"
            'prompt' => 'consent',
        ]);


        return redirect(getenv('JOAUTH_URL').'?'.$query);
    })->name('auth.sso');


    Route::get('/callback', function(Request $request){

        return to_route('login');
        // return $request;
    });
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // custom password reset if check
    Route::get('dashboard/account/password-reset', [AccountController::class, 'showPasswordResetPage'])->name('dashboard.account.reset-password');
    Route::post('dashboard/account/password-reset', [AccountController::class, 'resetNewPassword'])->name('dashboard.account.reset-password');
});
