<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $order_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $order_id)
    {
        $this->user = $user;
        $this->order_id = $order_id;
    }

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
                    ->where('orders.order_id', $this->order_id)
                    ->select('users.id', 'users.email', 'users.firstName', 'users.lastName', 'users.profile_photo_path',
                                'users.name', 'users.provider_id', 'users.avatar', 'orders.id as orderId',
                                'orders.order_id', 'orders.user_id', 'orders.product_id', 'orders.quantity', 'orders.isOncart',
                                'orders.isCheckout', 'orders.isShipped', 'orders.isDelivered', 'orders.created_at', 'orders.updated_at')
                    ->get()
                    ->first();

        return [
            'user' => $user,
        ];
    }
}
