@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add new question</div>

                    <div class="card-body">
                        <form action="/questionnaires/{{ $questionnaire->id }}/questions" method="post">
                            <div class="container">
                                @csrf
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <input type="text" class="form-control" id="question" name="question[question]" autocomplete="off" value="{{ old('question.question') }}" placeholder="Enter you question">
                                    @error('question.question')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <h3>Answers</h3>
                                    <small class="form-text text-muted mb-4">Give choices of answers that give the most insight into your question</small>

                                    <div class="form-group">
                                        <label for="answer1">Answer 1</label>
                                        <input type="text" class="form-control" id="answer1" name="answers[][answer]" autocomplete="off" value="{{ old('answers.0.answer') }}" placeholder="Enter you answer">
                                        @error('answers.0.answer')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <label for="answer2">Answer 2</label>
                                        <input type="text" class="form-control" id="answer2" name="answers[][answer]" autocomplete="off" value="{{ old('answers.1.answer') }}" placeholder="Enter you answer">
                                        @error('answers.1.answer')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <label for="answer3">Answer 3</label>
                                        <input type="text" class="form-control" id="answer3" name="answers[][answer]" autocomplete="off" value="{{ old('answers.2.answer') }}" placeholder="Enter you answer">
                                        @error('answers.2.answer')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
