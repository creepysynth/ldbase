@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create questionnaire</div>

                    <div class="card-body">
                        <form action="{{ route('questionnaires.store') }}" method="post">
                            <div class="container">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" autocomplete="off" value="{{ old('title') }}" placeholder="Enter title">
                                    @error('title')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="purpose">Purpose</label>
                                    <input type="text" class="form-control" id="purpose" name="purpose" autocomplete="off" value="{{ old('purpose') }}" placeholder="Enter purpose">
                                    @error('purpose')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Create questionnaire</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
