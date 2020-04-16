<?php
namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies, $nowPlaying, $genres;

    public function __construct($popularMovies, $nowPlaying, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        return $this->formatted($this->popularMovies);
    }

    public function nowPlaying()
    {
        return $this->formatted($this->nowPlaying);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
                        return [
                            $genre['id'] => $genre['name']
                        ];
                    });
    }

    private function formatted($movies)
    {
        return collect($movies)->map(function($movie) {
            $formattedGenres = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(' . ');
            return collect($movie)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500{$movie['poster_path']}",
                'vote_average' => $movie['vote_average'] * 10,
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $formattedGenres
            ])->only(
                'id', 'poster_path', 'vote_average', 'release_date', 'genre_ids', 'title', 'genres'
            );
        });
    }
}
