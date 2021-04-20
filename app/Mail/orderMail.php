<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderMail extends Mailable implements ShouldQueue
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
        if($this->orders->first()->isCheckout == true)
        {
            return $this->subject('Your order has been shipped - Owlsome')
            ->markdown('emails.order-mail');
        }elseif($this->orders->first()->isShipped == true)
        {
            return $this->subject('Owlsome Receipt')
            ->markdown('emails.order-mail');
        }
    }
}
