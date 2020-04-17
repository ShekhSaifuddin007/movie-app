<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowsViewModel extends ViewModel
{
    public $popularShows, $topRatedShows, $genres;

    public function __construct($popularShows, $topRatedShows, $genres)
    {
        $this->popularShows = $popularShows;
        $this->topRatedShows = $topRatedShows;
        $this->genres = $genres;
    }

    public function popularShows()
    {
        return $this->formatted($this->popularShows);
    }

    public function topRatedShows()
    {
        return $this->formatted($this->topRatedShows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [
                $genre['id'] => $genre['name']
            ];
        });
    }

    private function formatted($tvShow)
    {
        return collect($tvShow)->map(function($tv) {
            $genresFormatted = collect($tv['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(' . ');

            return collect($tv)->merge([
                'poster_path' => $tv['poster_path']
                    ? "https://image.tmdb.org/t/p/w500/{$tv['poster_path']}"
                    : "https://via.placeholder.com/500x750.png?text={$tv['name']}",
                'vote_average' => $tv['vote_average'] * 10,
                'first_air_date' => Carbon::parse($tv['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only(
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            );
        });
    }
}
