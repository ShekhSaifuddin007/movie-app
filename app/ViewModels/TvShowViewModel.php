<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tv;

    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function tv()
    {
        return collect($this->tv)->merge([
            'poster_path' => "https://image.tmdb.org/t/p/w500{$this->tv['poster_path']}",
            'vote_average' => $this->tv['vote_average'] * 10,
            'first_air_date' => Carbon::parse($this->tv['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tv['genres'])->pluck('name')->implode(' . '),
            'cast' => collect($this->tv['credits']['cast'])->take(10)->map(function($cast) {
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? "https://image.tmdb.org/t/p/w300{$cast['profile_path']}"
                        : "https://via.placeholder.com/300x450.png?text={$cast['name']}",
                ]);
            }),
            'images' => collect($this->tv['images']['backdrops'])->take(9),
        ])->only(
            'id', 'poster_path', 'vote_average', 'first_air_date', 'genres', 'crew', 'cast', 'images', 'name', 'overview', 'videos', 'credits', 'created_by'
        )->dump();
    }
}
