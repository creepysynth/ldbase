@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">Welcome {{ Auth::user()->name }}!</div>
                    <div class="card-body">
                        <a href="{{ route('questionnaires.create') }}" class="btn btn-info">Create new questionnaire</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">My questionnaires</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @forelse($questionnaires as $questionnaire)
                                <li class="list-group-item">
                                    <a href="{{ route('questionnaires.show', ['questionnaire' => $questionnaire->id]) }}">{{ $questionnaire->title }}</a>
                                    @if($questionnaire->questions->isNotEmpty())
                                        <div class="mt-3">
                                            <small class="font-weight-bold">Share URL:</small>
                                            <p>
                                                <a href="{{ route(
                                                        'surveys.show',
                                                        [
                                                            'questionnaire' => $questionnaire->id,
                                                            'slug' => Str::slug($questionnaire->title)
                                                        ]
                                                    ) }}">
                                                    {{ route(
                                                        'surveys.show',
                                                        [
                                                            'questionnaire' => $questionnaire->id,
                                                            'slug' => Str::slug($questionnaire->title)
                                                        ]
                                                    ) }}
                                                </a>
                                            </p>
                                        </div>
                                    @else
                                        <p class="mt-3">No questions added yet</p>
                                    @endif
                                </li>
                            @empty
                                No questionnaires available
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
