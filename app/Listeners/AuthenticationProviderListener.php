<?php

namespace App\Listeners;

use App\Events\AuthenticationProviderEvent;
use App\Mail\AuthenticationProviderMail;
use App\Notifications\AuthenticationProviderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class AuthenticationProviderListener
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
     * @param  AuthenticationProviderEvent  $event
     * @return void
     */
    public function handle(AuthenticationProviderEvent $event)
    {
        Notification::send($event->user, new AuthenticationProviderNotification($event->user, $event->generatedPassword));
        Mail::to($event->user->email)->send(new AuthenticationProviderMail($event->user, $event->generatedPassword));
    }
}
