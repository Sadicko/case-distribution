<?php

use App\Http\Middleware\CheckPasswordReset;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->throttleWithRedis();
        $middleware->alias([
            'auth.reset-password' => CheckPasswordReset::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        //schedule commands
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->weekdays()->everyThreeHours($minutes = 0)->between('6:00', '18:00');
    })->create();
