<?php

namespace App\Listeners\EventMessage;

use App\Events\CounterChanged;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeCount1 implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  CounterChanged  $event
     * @return void
     */
    public function handle(CounterChanged $event)
    {
        $event->counter->update([
            'count1' => $event->counter->count1 + 1,
        ]);
    }
}
