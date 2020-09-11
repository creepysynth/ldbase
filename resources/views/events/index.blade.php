@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($counter)
            <h3>Count 1: <span style="color:red">{{ $counter->count1 }}</span></h3>
            <h3>Count 2: <span style="color:red">{{ $counter->count2 }}</span></h3>
        @else
            <h3>No event message in database! Click button below to create one.</h3>
        @endif
        <a href="/events/edit" class="btn btn-primary mt-2">Change counts</a>
    </div>
@endsection

