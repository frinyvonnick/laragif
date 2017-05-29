<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StarEvent implements ShouldBroadcast
{
    use SerializesModels, Dispatchable, InteractsWithSockets;
    public $url;
    public $user;

    public function __construct(string $url, string $user)
    {
        $this->url = $url;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return new Channel('everyone');
    }
}
