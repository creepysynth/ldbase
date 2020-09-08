@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create service</h1>
        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{ old('name') }}">
            </div>
            <p style="color:red;">@error('name'){{ $message }}@enderror</p>
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputPassword1">Password</label>--}}
{{--                    <input type="password" class="form-control" id="exampleInputPassword1">--}}
{{--                </div>--}}
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="active" name="active" @if(old('active') == 'on') checked @endif>
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
