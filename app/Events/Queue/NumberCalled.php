<?php

namespace App\Events\Queue;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NumberCalled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $next_number, $panel;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($next_number, $panel)
    {
        $this->next_number = $next_number;
        $this->panel = $panel;
    }

    public function broadcastAs()
    {
        return 'next-number-updated';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $this->dontBroadcastToCurrentUser();
        return new Channel('number-update-channel');
    }
}
