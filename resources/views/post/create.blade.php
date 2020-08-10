@extends('layouts.app')

@section('content')
    <form action="" method="post">
        <label for="channel_id">Select channel</label>
        <br>
        <select name="channel_id" id="channel_id">
            @forelse($channels as $channel)
                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
            @empty
                No channels yet
            @endforelse
        </select>
    </form>
@endsection