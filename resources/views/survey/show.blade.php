@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $questionnaire->title }}</h1>

                <form action="{{ route(
                        'surveys.show',
                            [
                                'questionnaire' => $questionnaire->id,
                                'slug' => Str::slug($questionnaire->title)
                            ]
                    ) }}"
                    method="post">
                    @csrf
                    @foreach($questionnaire->questions as $key => $question)
                        <div class="card mt-3">
                            <div class="card-header">
                                <strong>{{ $key + 1 }}.</strong>
                                <a href="{{ route('questions.show', ['question' => $question->id]) }}"> {{ $question->question }}</a>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($question->answers as $answer)
                                        <label for="answer{{ $answer->id }}">
                                            <li class="list-group-item">
                                                <input class="mr-2" id="answer{{ $answer->id }}" type="radio"
                                                       name="responses[{{ $key }}][answer_id]"
                                                       {{ old("responses.$key.answer_id") == $answer->id ? 'checked' : '' }}
                                                       value="{{ $answer->id }}">
                                                {{ $answer->answer }}

                                                <input type="hidden"
                                                       name="responses[{{ $key }}][question_id]"
                                                       value="{{ $question->id }}">
                                            </li>
                                        </label>
                                    @endforeach
                                </ul>
                                @error("responses.$key.answer_id")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    <div class="card mt-3">
                        <div class="card-header">Your information</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="survey[name]" autocomplete="off" value="{{ old('survey.name') }}" placeholder="Enter your name">
                                @error('survey.name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="survey[email]" autocomplete="off" value="{{ old('survey.email') }}" placeholder="Enter your email">
                                @error('survey.email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
