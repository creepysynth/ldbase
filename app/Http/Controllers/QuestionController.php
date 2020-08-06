<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Questionnaire $questionnaire
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(Questionnaire $questionnaire)
    {
        return view('questions.create', compact('questionnaire'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Questionnaire $questionnaire
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Questionnaire $questionnaire)
    {
//        dd($request->all());

        $data = request()->validate([
            'question.question' => 'required',
            'answers.*.answer' => 'required'
        ]);

        $question = $questionnaire->questions()->create($data['question']);
        $question->answers()->createMany($data['answers']);

        return redirect( route('questionnaires.show', ['questionnaire' => $questionnaire->id]) );
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Questionnaire $questionnaire
     * @param Question $question
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Questionnaire $questionnaire, Question $question)
    {
        $question->answers()->delete();
        $question->delete();

        return redirect( route('questionnaires.show', ['questionnaire' => $questionnaire->id]) );
    }
}
