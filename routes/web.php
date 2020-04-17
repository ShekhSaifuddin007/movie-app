<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movie/{movie}', 'MoviesController@show')->name('movies.show');

Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page={page?}', 'ActorsController@index');
Route::get('/actors/{actor}', 'ActorsController@show')->name('actors.show');

Route::get('tv-shows', 'TvShowsController@index')->name('tv.index');
Route::get('tv-shows/{tv}', 'TvShowsController@show')->name('tv.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
