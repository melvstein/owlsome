<?php

namespace App\Providers;

use App\Events\AuthenticationProviderEvent;
use App\Events\CustomerOrderEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Events\OrderProcessEvent;
use App\Listeners\AuthenticationProviderListener;
use App\Listeners\CustomerOrderListener;
use App\Listeners\OrderListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderProcessEvent::class => [
            OrderListener::class,
        ],
        CustomerOrderEvent::class => [
            CustomerOrderListener::class,
        ],
        AuthenticationProviderEvent::class => [
            AuthenticationProviderListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
