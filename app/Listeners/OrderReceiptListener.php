<?php

namespace App\Listeners;

use App\Events\OrderProcessEvent;
use App\Mail\OrderReceiptMail;
use App\Models\CityShippingFee;
use App\Models\ShippingDetails;
use App\Notifications\Invoice;
use App\Notifications\OrderReceiptNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class OrderReceiptListener
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
    public function handle( $event)
    {
        $shippingDetails = ShippingDetails::where('order_id', $event->order->first()->order_id)->get()->first();
        $city = $shippingDetails->city;
        $cityFee = CityShippingFee::where('city', $city)->get()->first();
        $shippingFee = $cityFee->shipping_fee;
        $when = now()->addMinutes(1);
        Notification::send($event->order->first(), new OrderReceiptNotification($event->order->first()));
        Mail::to($event->order->first()->email)->send(new OrderReceiptMail($event->order, $shippingFee));
    }
}
