<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movie/name', 'MoviesController@show')->name('movies.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
