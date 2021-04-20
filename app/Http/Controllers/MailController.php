<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceiptMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function orderReceipt($email)
    {
        $details = [
            'title' => 'Owlsome Order Receipt',
            'body' => 'Your order was delivered successfully!'
        ];

        Mail::to($email)->send(new OrderReceiptMail($details));
    }
}
