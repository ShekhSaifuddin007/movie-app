<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{

    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/movie/popular')
                                ->json()['results'];

        $genresArray = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/genre/movie/list')
                                ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
                                    return [
                                        $genre['id'] => $genre['name']
                                    ];
                            });

        $nowPlaying = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/now_playing')
                            ->json()['results'];

        //dump($nowPlaying);

        return view('front.movie.index', compact('popularMovies', 'genres', 'nowPlaying'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($movie)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
                        ->get("https://api.themoviedb.org/3/movie/{$movie}?append_to_response=credits,videos,images")
                        ->json();

        dump($movie);

        return view('front.movie.show', compact('movie'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
