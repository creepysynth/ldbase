<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewServiceCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $service;
    public $user;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Service $service
     * @param \App\User $user
     */
    public function __construct($service, $user)
    {
        $this->service = $service;
        $this->user = $user;
    }
}
