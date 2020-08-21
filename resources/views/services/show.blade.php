@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <h1>{{ $service->name }}</h1>
            <h4>@if($service->active) active @else inactive @endif</h4>
            <div class="row">
                <a href="/services" class="btn btn-primary mr-2">Back</a>
                <a href="/services/{{ $service->id }}/edit" class="btn btn-success mr-2">Edit</a>
                <form action="/services/{{ $service->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </body>
@endsection