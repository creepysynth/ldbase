<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/{any}', 'AppController@index')->where('any', '.*');

//Route::get('/home', 'HomeController@index')->name('home');
