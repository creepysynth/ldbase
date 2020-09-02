<?php

namespace App\Listeners;

use App\Events\NewServiceCreated;
use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NewServiceSendEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewServiceCreated  $event
     * @return void
     */
    public function handle(NewServiceCreated $event)
    {
        // We have to provide user's object or we get error. ShouldQueue does not serialise Auth::user().
        // NOTE: Do not forget to rerun "php artisan queue:work" every time you make changes in code.

        // Option 1. ErrorException: Trying to get property 'email' of non-object
//        Mail::to(Auth::user()->email)->send(new WelcomeMail($event->service));

        // Option 2. Using user's object from App\Events\NewServiceCreated $user property. No error.
        Mail::to($event->user->email)->send(new WelcomeMail($event->service));
    }
}
