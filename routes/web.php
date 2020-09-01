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
Auth::routes();




// Redirect option 1.
//Route::get('/', function () {
//    return redirect('/questionnaires');
//});

// Redirect option 2.
Route::redirect('/', '/questionnaires');

Route::resources([
//    '/services' => 'ServiceController',
    '/questionnaires' => 'QuestionnaireController'
]);

Route::get('/email', function() {
    return new WelcomMail();
});

Route::get('/home', 'HomeController@index')->name('home');

// Лучше создавать CRUD в такой последовательности. Иначе у некоторых маршрутов будет выскакивать ошибка 404.
Route::post('/services', 'ServiceController@store')->name('services.store');
Route::get('/services', 'ServiceController@index')->name('services.index');
// Laravel 5.8 Tutorial From Scratch - e23 - Adding a Custom Middleware
// Option 3. Use our middleware rule as pseudonym on specific route.
Route::get('/services/create', 'ServiceController@create')
    ->name('services.create')
    ->middleware('test.middleware');
Route::delete('/services/{service}', 'ServiceController@destroy')->name('services.destroy');
Route::get('/services/{service}', 'ServiceController@show')->name('services.show');
Route::patch('/services/{service}', 'ServiceController@update')->name('services.update');
Route::get('/services/{service}/edit', 'ServiceController@edit')->name('services.edit');

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
