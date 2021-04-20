<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderReceiptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /* public $afterCommit = false; */

    public $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Determine which queues should be used for each notification channel.
     *
     * @return array
     */

    /* public function viaQueues()
    {
        return [
            'mail' => 'mail-queue',
            'database' => 'database-queue',
        ];
    } */

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $user = User::join('orders', 'users.id', 'orders.user_id')
                    ->where('orders.order_id', $this->order->order_id)
                    ->select('orders.*', 'users.firstName', 'users.middleName', 'users.lastName', 'users.id as userid', 'users.email')
                    ->get()
                    ->first();

        return [
            'user' => $user,
        ];
    }
}
