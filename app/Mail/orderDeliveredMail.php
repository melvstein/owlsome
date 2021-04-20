<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderDeliveredMail extends Mailable implements ShouldQueue
{
    use Queueable;

    public $orders;
    public $shippingFee;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders, $shippingFee)
    {
        $this->orders = $orders;
        $this->shippingFee = $shippingFee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->subject('Your order has been delivered successfully! - Owlsome')
                    ->markdown('mails.order.delivered');
    }
}
