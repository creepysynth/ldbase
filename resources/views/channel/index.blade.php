@extends('layouts.app')

@section('content')
<ul>
    @forelse($channels as $channel)
        <li>{{ $channel->name }}</li>
    @empty
        No channels yet
    @endforelse
</ul>
@endsection
