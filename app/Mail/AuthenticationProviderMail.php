<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthenticationProviderMail extends Mailable implements ShouldQueue
{
    use Queueable;

    public $user;
    public $generatedPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $generatedPassword)
    {
        $this->user = $user;
        $this->generatedPassword = $generatedPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Owlsome Generated Password for your new account')
                    ->markdown('mails.customer.authentication-provider');
    }
}
