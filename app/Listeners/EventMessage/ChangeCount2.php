<?php

namespace App\Listeners\EventMessage;

use App\Events\CounterChanged;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeCount2 implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  CounterChanged  $event
     * @return void
     */
    public function handle(CounterChanged $event)
    {
        sleep(5);

        $event->counter->update([
            'count2' => $event->counter->count2 + 1,
        ]);
    }
}
