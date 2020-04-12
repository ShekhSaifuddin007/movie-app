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

        dump($popularMovies);

        return view('front.movie.index', compact('popularMovies'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        return view('front.movie.show');
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
