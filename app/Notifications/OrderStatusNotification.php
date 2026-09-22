<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $status;

    public function __construct($order, $status)
    {
        $this->order = $order;
        $this->status = $status;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $messages = [
            'pending' => 'Your order is pending.',
            'confirmed' => 'Your order has been confirmed.',
            'preparing' => 'Your order is being prepared.',
            'out_for_delivery' => 'Your order is on the way.',
            'delivered' => 'Your order has been delivered.',
            'cancelled' => 'Your order has been cancelled.',
        ];

        return [
            'type' => 'order_status',
            'order_id' => $this->order->id,
            'status' => $this->status,
            'message' => $messages[$this->status] ?? 'Your order status has been updated.',
        ];
    }
}

