<?php

namespace App\Listeners;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeNotification
{
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
    public function handle(\App\Events\UserRegistered $event)
    {
        // dd($event->user);
        Mail::to($event->user->email)->send(new \App\Mail\WelcomeMail($event->user));
    }
}
