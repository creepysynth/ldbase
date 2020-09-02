<?php

namespace App\Listeners;

use App\Events\NewServiceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PrintMessage implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  NewServiceCreated  $event
     * @return void
     */
    public function handle(NewServiceCreated $event)
    {
        sleep(10);
        dump('Second message');
    }
}
