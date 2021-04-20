<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == "Customer")
        {
            auth()->user()->notifications->markAsRead();
        }else{
            $adminNotif = DatabaseNotification::where('notifiable_id', 1)->where('read_at', null);

            $adminNotif->update([
                'read_at' => now(),
            ]);
        }

        $oncartCount = Order::oncartCount();
        $notifications = DatabaseNotification::where('type', '!=', "App\Notifications\CustomerOrderNotification")->orderBy('updated_at', 'desc')->get();
        return view('user.'. Str::lower(auth()->user()->role) .'.notification.index', compact('notifications', 'oncartCount'));
    }
}
