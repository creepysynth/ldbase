<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CounterChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $counter;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Counter $counter
     */
    public function __construct($counter)
    {
        $this->counter = $counter;
    }
}
