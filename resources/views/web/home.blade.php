@extends('layouts.web')
@section('content')
    <div class="w-full mx-auto px-0">
        <div class="max-w-full mx-auto bg-center bg-no-repeat bg-cover" style="background-image: url({{ asset('images/jonathan-velasquez-c1ZN57GfDB0-unsplash.jpg') }})">
            <div class="h-full w-full bg-bluegray-800 bg-opacity-60 text-black backdrop-filter backdrop-blur-lg mx-auto flex items-center justify-center">
                <div class="max-w-5xl mx-auto py-64 px-4 sm:px-6 lg:px-8 mt-8">
                    <div class="text-5xl font-black mx-auto text-yellow-400 rounded-lg">{{ __('Inform. Inspire. Change.') }}</div>
                    <div class="text-xl font-semibold text-white py-4 rounded-lg">{{ __('Quickly publish your shows, and distribute them on big podcast players, such as Spotify, Apple Podcasts, and Google Podcasts.') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        {{-- Getting Started Articles --}}
        <div class="mt-24 grid grid-cols-2 gap-8 items-center">
            <div class="col-span-2 sm:col-span-1 prose">
                <h1 class="text-blueGray-800">{{ __("Want to create a podcast but don't know where to start?") }}</h1>
                <p class="text-blueGray-600">{{ __("We have written some useful guides to help you get started. If you still have any questions, let us know. We will be more than happy to assist.") }}</p>
                <a  href="{{ route('help') }}">
                    {{ __("Learn more") }}
                </a>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <img src="{{ asset("images/undraw_To_the_stars_qhyy.svg") }}" alt="undraw To the stars qhyy" class="">
            </div>
        </div>
    </div>
@endsection
