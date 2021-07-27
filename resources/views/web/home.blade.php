@extends('layouts.web')
@section('content')
<div class="w-full mx-auto px-0">
    <div class="h-full w-full text-black mx-auto flex items-center justify-center relative">

        <div class="absolute w-72 h-72 mr-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob z-0"></div>
        <div class="absolute w-72 h-72 ml-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob animation-delay-2000 z-0"></div>
        <div class="absolute w-72 h-72 mt-8 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-60 animate-blob animation-delay-4000 z-0"></div>

        <div class="max-w-5xl mx-auto py-48 px-4 sm:px-6 lg:px-8 mt-8 text-center z-10">
            <div class="text-5xl font-black text-bluegray-800 rounded-lg">{{ __('Inform. Inspire. Change.') }}</div>
            <div class="max-w-3xl text-xl font-semibold text-bluegray-800 py-4">{{ __('Get your podcast out to your listeners in no time with our easy to use publishing platform.') }}</div>
        </div>
    </div>
</div>











































    {{-- <div class="w-full mx-auto px-0">
        <div class="max-w-full mx-auto bg-center bg-no-repeat bg-cover" style="background-image: url({{ asset('storage/will-francis-ZDNyhmgkZlQ-unsplash.jpg') }})">
            <div class="h-full w-full bg-bluegray-800 bg-opacity-60 text-black backdrop-filter backdrop-blur-lg mx-auto flex items-center justify-center">
                <div class="max-w-5xl mx-auto py-64 px-4 sm:px-6 lg:px-8 mt-8">
                    <div class="text-5xl font-black mx-auto text-yellow-400 rounded-lg">{{ __('Inform. Inspire. Change.') }}</div>
                    <div class="text-xl font-semibold text-white py-4 rounded-lg">{{ __('Quickly publish your shows, and distribute them on big podcast players, such as Spotify, Apple Podcasts, and Google Podcasts.') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
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
    </div> --}}
@endsection
