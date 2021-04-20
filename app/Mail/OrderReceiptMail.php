<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReceiptMail extends Mailable implements ShouldQueue
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
        return $this->subject("Owlsome Order Receipt")
                    ->markdown('emails.orders.receipt');
    }
}
