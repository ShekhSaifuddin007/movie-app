<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    public function index($page = 1)
    {
//        abort_if($page > 500, 204);

        $popularActors = Http::withToken(config('services.tmdb.token'))
                                ->get("https://api.themoviedb.org/3/person/popular?page={$page}")
                                ->json()['results'];

        //dump($popularActors);
        $viewModel = new ActorsViewModel($popularActors, $page);

        return view('front.actors.index', $viewModel);
    }

    public function show($actor)
    {
        $actor = Http::withToken(config('services.tmdb.token'))
                        ->get("https://api.themoviedb.org/3/person/{$actor}")
                        ->json();

        $social = Http::withToken(config('services.tmdb.token'))
                        ->get("https://api.themoviedb.org/3/person/{$actor['id']}/external_ids")
                        ->json();

        $credits = Http::withToken(config('services.tmdb.token'))
                            ->get("https://api.themoviedb.org/3/person/{$actor['id']}/combined_credits")
                            ->json();

        $viewModel = new ActorViewModel($actor, $social, $credits);

        return view('front.actors.show', $viewModel);
    }
}
