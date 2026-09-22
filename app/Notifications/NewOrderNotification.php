<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'new_order',

            'order_id' => $this->order->id,

            'message' => 'You have a new order!',

            'url' => route(
                'restaurant.orders.index',
                $this->order->restaurant_id
            ),
        ];
    }
}

