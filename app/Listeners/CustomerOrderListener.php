<?php

namespace App\Listeners;

use App\Events\CustomerOrderEvent;
use App\Mail\CustomerOrderMail;
use App\Models\User;
use App\Notifications\CustomerOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CustomerOrderListener
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
     * @param  CustomerOrderEvent  $event
     * @return void
     */
    public function handle(CustomerOrderEvent $event)
    {
        $adminUser = User::findOrFail(1);
        $customer = User::findOrFail($event->details->first()->user_id);

        Notification::send($adminUser, new CustomerOrderNotification($event->details->first()));
        Mail::to($adminUser->email)->send(new CustomerOrderMail($customer, $event->details->first()));
    }
}
