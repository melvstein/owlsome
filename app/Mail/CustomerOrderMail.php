<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerOrderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $customer;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $details)
    {
        $this->customer = $customer;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->customer->email)
                    ->subject('New Order: '.$this->details->order_id)
                    ->markdown('mails.customer.order-mail');
    }
}
