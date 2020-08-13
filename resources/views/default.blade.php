@extends('layouts.app')

@section('content')
    @if(is_array($data))
            @forelse($data as $key => $val)
                <h4>"{{ $key }}": {{ $val }}</h4>
            @empty
                No data in array!
            @endforelse
    @else
        <h4>{{ $data }}</h4>
    @endif
@endsection