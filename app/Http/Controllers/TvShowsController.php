<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowsViewModel;
use App\ViewModels\TvShowViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvShowsController extends Controller
{
    public function index()
    {
        $popularShows = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/tv/popular')
                                ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/tv/list')
                            ->json()['genres'];

        $topRatedShows = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/tv/top_rated')
                                ->json()['results'];

        $viewModel = new TvShowsViewModel($popularShows, $topRatedShows, $genres);

        return view('front.tv-shows.index', $viewModel);
    }

    public function show($tv)
    {
        $tv = Http::withToken(config('services.tmdb.token'))
                        ->get("https://api.themoviedb.org/3/tv/{$tv}?append_to_response=credits,videos,images")
                        ->json();
        $viewModel = new TvShowViewModel($tv);
        return view('front.tv-shows.show', $viewModel);
    }
}
