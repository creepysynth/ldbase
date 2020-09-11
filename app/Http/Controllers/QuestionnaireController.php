<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Questionnaire::class, 'questionnaire');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $questionnaires = auth()->user()->questionnaires;

        return view('questionnaires.index', compact('questionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        // * Laravel 5.8 Tutorial From Scratch - e44 - Policies
        // Policy auto-discovery does not work, because we placed our Questionnaire model not
        // into app folder by default, but in app/Models. So we have to manually register aur
        // model policy in App\Providers\AuthServiceProvider.
//        $this->authorize('create', Questionnaire::class);

        return view('questionnaires.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $this->validatedData();

//        $data['user_id'] = Auth::id();
//        $questionnaire = Questionnaire::create($data);

        $questionnaire = Auth::user()->questionnaires()->create($data);

        return redirect( route('questionnaires.show', ['questionnaire' => $questionnaire->id]) );
    }

    /**
     * Display the specified resource.
     *
     * @param Questionnaire $questionnaire
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Questionnaire $questionnaire)
    {
        // lazy load questions and answers
        $questionnaire->load('questions.answers.responses');

        return view('questionnaires.show', compact('questionnaire'));
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
     * @param Questionnaire $questionnaire
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Questionnaire $questionnaire)
    {
        // * Laravel 5.8 Tutorial From Scratch - e44 - Policies
        // Policy auto-discovery does not work, because we placed our Questionnaire model not
        // into app folder by default, but in app/Models. So we have to manually register aur
        // model policy in App\Providers\AuthServiceProvider.
//        $this->authorize('delete', $questionnaire);
    }

    /**
     * Validate form data
     */
    private function validatedData()
    {
        return request()->validate([
            'title' => 'required|min:2|max:255',
            'purpose' => 'required|min:2|max:255'
        ]);
    }
}
