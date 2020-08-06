@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $questionnaire->title }}</div>
                    <div class="card-body">
                        <div class="mb-4">{{ $questionnaire->purpose }}</div>
                        <a href="{{ route('questions.create', ['questionnaire' => $questionnaire->id]) }}" class="btn btn-dark">Add new question</a>

                        @if($questionnaire->questions->isNotEmpty())
                            <a href="{{ route(
                                    'surveys.show',
                                    [
                                        'questionnaire' => $questionnaire->id,
                                        'slug' => Str::slug($questionnaire->title)
                                    ]
                                ) }}"
                                class="btn btn-dark">Take survey
                            </a>
                        @endif
                    </div>
                </div>
                @foreach($questionnaire->questions as $question)
                    <div class="card mt-3">
                        <div class="card-header">
                            <a href="{{ route('questions.show', ['question' => $question->id]) }}">{{ $question->question }}</a>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach($question->answers as $answer)
                                    <li class="d-flex justify-content-between">
                                        <div>{{ $answer->answer }}</div>
                                        @if($question->responses->count())
                                            <div>{{ round($answer->responses->count() * 100 / $question->responses->count(), 1) }}%</div>
                                            <div>{{ $answer->responses->count() }}</div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('questions.destroy', ['questionnaire' => $questionnaire->id, 'question' => $question->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-danger">Delete question</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
