@extends('layouts.podcast', ['name' => $name, 'description' => $description, 'thumbnail' => $thumbnail])
@section('content')

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">

        <div class="flex flex-col items-center space-y-8 sm:items-start sm:space-y-0 sm:flex-row gap-8">
            <span class="sr-only">Home</span>
            <img src="{{ $thumbnail }}" class="h-28 w-28 sm:h-36 sm:w-36 rounded-lg object-cover">

            <div class="text-center sm:text-left">
                <h1 class="text-3xl leading-9 tracking-tight font-extrabold text-gray-900 sm:text-4xl sm:leading-10">{{$name}}</h1>
                <div class="mt-2">
                    <p class="text-xl leading-7 text-gray-500">
                        @parsedown($description)
                    </p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="my-6 flex gap-2">
                        <a  href="{{ route('genRss', ['podcast' => $url]) }}" target="_blank" class="text-sm font-semibold text-gray-500 mr-2">RSS</a>

                        @isset($spotifypodcasts_url)
                            <a href="{{ $spotifypodcasts_url }}" target="_blank" class="text-sm font-semibold text-gray-500 mr-2">Spotify</a>
                        @endisset

                        @isset($applepodcasts_url)
                            <a href="{{ $applepodcasts_url }}" target="_blank" class="text-sm font-semibold text-gray-500 mr-2">Apple Podcasts</a>
                        @endisset

                        @isset($googlepodcasts_url)
                            <a href="{{ $googlepodcasts_url }}" target="_blank" class="text-sm font-semibold text-gray-500 mr-2">Google Podcasts</a>
                        @endisset
                    </div>

                    @auth
                        @livewire('podcast.follow', ['user_id' => auth()->user()->id, 'podcast_id' => $podcast_id])
                    @endauth
                </div>
            </div>

        </div>
        <div class="my-6 border-t"></div>
        {{-- @livewire('player.playlist', ['podcast' => $slug, 'episodes' => $episodes]) --}}
    </div>
@endsection
