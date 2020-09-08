@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit service</h1>
        <form action="{{ route('services.update', ['service' => $service->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{ $service->name }}">
            </div>
            <p style="color:red;">@error('name'){{ $message }}@enderror</p>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="active" name="active" @if($service->active == 'Active') checked @endif>
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-group d-flex flex-column">
                <label for="image">Image</label>
                <input type="file" name="image">
{{--                <p style="color:red;">@error('image'){{ $message }}@enderror</p>--}}
                <p style="color:red;">{{ $errors->first('image') }}</p>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
