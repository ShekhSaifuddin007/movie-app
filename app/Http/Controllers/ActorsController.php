<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    public function index($page = 1)
    {
        $popularActors = Http::withToken(config('services.tmdb.token'))
                                ->get("https://api.themoviedb.org/3/person/popular?page={$page}")
                                ->json()['results'];

        //dump($popularActors);
        $viewModel = new ActorsViewModel($popularActors, $page);

        return view('front.actors.index', $viewModel);
    }

    public function show()
    {
        //
    }
}
