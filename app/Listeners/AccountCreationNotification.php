<?php

namespace App\Listeners;

use App\Events\AccountCreationEvent;
use App\Mail\AccountCreationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AccountCreationNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AccountCreationEvent $event): void
    {
        \Mail::to($event->user->email)->send( new AccountCreationMail($event->user));
    }
}
