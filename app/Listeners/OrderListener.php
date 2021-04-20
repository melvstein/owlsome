<?php

namespace App\Listeners;

use App\Events\OrderProcessEvent;
use App\Mail\orderDeliveredMail;
use App\Mail\orderMail;
use App\Mail\OrderReceiptMail;
use App\Mail\orderShippedMail;
use App\Models\CityShippingFee;
use App\Models\ShippingDetails;
use App\Notifications\OrderNotification;
use App\Notifications\OrderReceiptNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class OrderListener
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
     * @param  OrderProcessEvent  $event
     * @return void
     */
    public function handle(OrderProcessEvent $event)
    {
        /* dd($event); */
        $shippingDetails = ShippingDetails::where('order_id', $event->user->first()->order_id)->get()->first();
        $city = $shippingDetails->city;
        $cityFee = CityShippingFee::where('city', $city)->get()->first();
        $shippingFee = $cityFee->shipping_fee;
        $when = now()->addMinutes(1);

        Notification::send($event->user->first(), new OrderNotification($event->user->first(), $event->user->first()->order_id));

        if($event->user->first()->isCheckout)
        {
            Mail::to($event->user->first()->email)->send(new orderShippedMail($event->user));
        }elseif($event->user->first()->isShipped)
        {
            Mail::to($event->user->first()->email)->send(new orderDeliveredMail($event->user, $shippingFee));
        }

    }
}
