<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;

class SurveyController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Questionnaire $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function store(Questionnaire $questionnaire)
    {
//        dd(request()->all());

        $data = request()->validate([
            'responses.*.answer_id'   => 'required',
            'responses.*.question_id' => 'required',
            'survey.name'             => 'required',
            'survey.email'            => 'required|email'
        ]);

        $survey = $questionnaire->surveys()->create($data['survey']);
        $survey->responses()->createMany($data['responses']);

        return 'Thank you!';
    }

    /**
     * Display the specified resource.
     *
     * @param Questionnaire $questionnaire
     */
    public function show(Questionnaire $questionnaire, $slug)
    {
        //dd($slug);

        if ($questionnaire->questions->isEmpty())
        {
            abort(404);
//            return view('errors.404');
        }

        $questionnaire->load('questions.answers');

        return view('survey.show', compact('questionnaire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
