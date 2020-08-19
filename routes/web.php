<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    return redirect('/pay');
});

// Service Container. Lesson 1.
Route::get('/pay', 'PayOrderController@store')->name('pay.store');


// View composers & polymorphic relationships. Lessons 2 & 3.
Route::get('/channels', 'ChannelController@index')->name('channels.index');
Route::get('/posts/create', 'PostController@create')->name('posts.create');


// Facades. Lesson 4.
// Standard way
Route::get('/postcards/standard', function () {
    $postcard_service = new \App\PostcardSendingService('us', 4, 6);
    return $postcard_service->hello('Hello from standard way!', 'a@a.com');
})->name('postcards.standard');

// Advanced way
Route::get('/postcards/facade', function() {
    return \App\Postcard::hello('Hello from facade!', 'a@a.com');
})->name('postcards.facade');


// Macros. Lesson 5.
Route::get('/macros/str', function () {
    // Option 1. Macro.
//    $data = Str::partNumber('12345');
//    return view('default', compact('data'));
    // Option 2. Mixins
    $data['partNumber'] = Str::partNumber('12345');
    $data['prefix'] = Str::prefix('12345');
    return view('default', compact('data'));
})->name('macros.str');

Route::get('/macros/error', function () {
    $data = json_encode(Response::errorJson('An error occurred'));
    return view('default', compact('data'));
})->name('macros.error');


// Pipelines. Lesson 6.
Route::get('/posts', 'PostController@index')->name('posts.index');


// Repository Pattern. Lesson 7.
Route::get('/customers', 'CustomerController@index')->name('customers.index');
Route::get('/customers/{id}', 'CustomerController@show')->name('customers.show');


// Lazy collections & php generators. Lesson 7.
Route::get('/lazy', function () {
    $collection = \Illuminate\Support\LazyCollection::times(600000)
        ->map(function ($number) {
            return pow(2, $number);
        });

//    dd($collection->all());
    return 'done!';
});
