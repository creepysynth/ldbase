<?php

namespace App\Http\Controllers;

use App\Events\CounterChanged;
use App\Models\Counter;

class CounterController extends Controller
{
    public function index() {
        $counter = Counter::first();

        return view('events.index', compact('counter'));
    }

    public function edit()
    {
        $counter = Counter::first();

        if (! $counter)
        {
            Counter::create([
                'count1' => 1,
                'count2' => 1
            ]);
        }
        else
        {
            event(new CounterChanged($counter));
        }

        return redirect('/events');
    }
}
