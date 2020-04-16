<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{

    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/movie/popular')
                                ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/genre/movie/list')
                                ->json()['genres'];

        $nowPlaying = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/now_playing')
                            ->json()['results'];

        $viewModel = new MoviesViewModel($popularMovies, $nowPlaying, $genres);

        return view('front.movie.index', $viewModel);
    }

    public function show($movie)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
                        ->get("https://api.themoviedb.org/3/movie/{$movie}?append_to_response=credits,videos,images")
                        ->json();

        $viewModel = new MovieViewModel($movie);

        return view('front.movie.show', $viewModel);
    }
}
