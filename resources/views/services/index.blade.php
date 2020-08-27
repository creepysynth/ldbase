@extends('layouts.app')

@section('content')
    <body>
        <div class="container">
            <h1>Services</h1>
            <a href="{{ route('services.index') }}" class="btn btn-success">All</a>
            <a href="{{ route('services.index', ['active' => 1]) }}" class="btn btn-primary">Active</a>
            <a href="{{ route('services.index', ['active' => 0]) }}" class="btn btn-warning">Inactive</a>
            <ul class="mt-3">
                @forelse($services as $service)
                    <li><a href="/services/{{ $service->id }}">{{ $service->name }}</a> {{ $service->active }}</li>
                @empty
                    No services available
                @endforelse
            </ul>
            <a href="/services/create" class="btn btn-success">Create service</a>
        </div>
    </body>
@endsection