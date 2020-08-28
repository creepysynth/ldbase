<?php

use App\Mail\WelcomMail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return view('welcome');
    return redirect('/questionnaires');
});

Route::resources([
    '/services' => 'ServiceController',
    '/questionnaires' => 'QuestionnaireController'
]);

Route::get('/email', function() {
    return new WelcomMail();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Laravel 5.8 Tutorial From Scratch - e22 - Artisan Authentication Restricting Access with Middleware
// Restricting access to question page with middleware for unauthenticated users.
Route::get('/questions/{question}', 'QuestionController@show')
    ->name('questions.show')
    ->middleware('auth');

Route::get('/questionnaires/{questionnaire}/questions/create', 'QuestionController@create')->name('questions.create');
Route::post('/questionnaires/{questionnaire}/questions', 'QuestionController@store')->name('questions.store');
Route::delete('/questionnaires/{questionnaire}/questions/{question}', 'QuestionController@destroy')->name('questions.destroy');

Route::get('/surveys/{questionnaire}-{slug}', 'SurveyController@show')->name('surveys.show');
Route::post('/surveys/{questionnaire}-{slug}', 'SurveyController@store')->name('surveys.store');
