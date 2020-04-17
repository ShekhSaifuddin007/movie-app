@extends('layouts.app')

@section('title', 'Tv shows')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Tv Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach ($popularShows as $tv)
                    <x-tv-shows-card :tv="$tv"/>
                @endforeach

            </div>
        </div> <!-- /popular movies -->

        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated Tv Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach ($topRatedShows as $tv)
                    <x-tv-shows-card :tv="$tv"/>
                @endforeach

            </div>
        </div> <!-- /now playing movies -->
    </div>
@stop
