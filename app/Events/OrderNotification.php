<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderNotification
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;


    public $type;
    public $order;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $type, $user = null)
    {
        //
        $this->order = $order;
        $this->type = $type;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notify-order-fcm');
    }
}
