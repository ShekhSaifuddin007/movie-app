@extends('layouts.app')

@section('title', 'Actors')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="#">
                            <img src="{{ $actor['profile_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg text-gray-300">
                                {{ $actor['name'] }}
                            </a>
                            <div class="text-sm text-gray-400 truncate">
                                {{ $actor['known_for'] }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div> <!-- /popular actors -->

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">No more pages to load</p>
        </div>

{{--        <div class="flex justify-between py-16">--}}
{{--            @if ($previous)--}}
{{--                <a href="/actors/page={{ $previous }}">Previous</a>--}}
{{--            @else--}}
{{--                <div></div>--}}
{{--            @endif--}}

{{--            @if ($next)--}}
{{--                <a href="/actors/page={{ $next }}">Next</a>--}}
{{--            @else--}}
{{--                <div></div>--}}
{{--            @endif--}}
{{--        </div>--}}
    </div>
@stop

@section('scripts')
    <script src="//unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll( elem, {
            // options
            path: '/actors/page=@{{#}}',
            append: '.actor',
            // history: false,
            status: '.page-load-status'
        });
    </script>
@stop
