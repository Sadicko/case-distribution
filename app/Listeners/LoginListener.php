<?php

namespace App\Listeners;

use App\Traits\AuditTrailLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginListener
{
    use AuditTrailLog;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $date = $this->createAuditTrail('Logged in to the system');

        $event->user->update([
            'is_online' => 1,
            'login_at' => $date->created_at,
        ]);
    }
}
