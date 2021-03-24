@extends('layouts.web')
@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

        <div class="sm:flex">
            <div class="w-full sm:w-3/12 sm:pr-6 lg:pr-8">
                <img src="{{ $thumbnail }}" class="hidden sm:block rounded-lg">

                <div class="hidden sm:block my-6 text-sm text-gray-700">
                    @parsedown($description)
                </div>
            </div>

            <div class="w-full sm:w-9/12 sm:pl-6 lg:pl-8 my-4">
                <div class="flex sm:block">
                    <img src="{{ $thumbnail }}" class="sm:hidden rounded-lg w-16 h-16">
                    <div class="ml-4 sm:ml-0">
                        <h1 class="text-4xl capitalize font-semibold sm:font-bold">
                            {{ $name }}
                        </h1>
                        <p class="capitalize text-gray-600">
                            {{ __('By: ') . $author }}
                        </p>
                    </div>
                </div>

                <div class="block sm:hidden my-6 text-sm text-gray-700">
                    {{ $description }}
                </div>

                <audio
                    controls
                    controlsList="nodownload"
                    class="w-full mt-6 rounded-lg"
                    id="player"
                    type="audio/mpeg"
                    >
                </audio>

                <div class="sm:flex items-center mt-4">
                    <div class="mr-6">
                        <a href="{{ route('genRss', ['podcast' => $slug]) }}" target="_blank" class="w-full inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            <svg class="w-4 mr-2 text-yellow-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"></path>
                                <path d="M5.5 12a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-3-8.5a1 1 0 0 1 1-1c5.523 0 10 4.477 10 10a1 1 0 1 1-2 0 8 8 0 0 0-8-8 1 1 0 0 1-1-1zm0 4a1 1 0 0 1 1-1 6 6 0 0 1 6 6 1 1 0 1 1-2 0 4 4 0 0 0-4-4 1 1 0 0 1-1-1z"></path>
                            </svg>
                            {{__('RSS Feed')}}
                        </a>
                    </div>
                </div>

                {{-- Episodes --}}
                <div class="mt-10">
                    @livewire('player.playlist', ['episodes' => $episodes])
                </div>
            </div>
        </div>
    </div>
@endsection
