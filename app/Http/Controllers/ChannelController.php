<?php

namespace App\Http\Controllers;

use App\Channel;

class ChannelController extends Controller
{
    public function index()
    {
//        $channels = Channel::all();
//
//        return view('channel.index', compact('channels'));

        return view('channel.index');
    }
}
