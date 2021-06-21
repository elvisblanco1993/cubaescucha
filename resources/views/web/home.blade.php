@extends('layouts.web')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
        <div class="bg-no-repeat bg-bottom bg-fixed bg-cover w-full rounded-lg p-8 h-96 flex items-center" style="background-image: url('https://images.unsplash.com/photo-1507676385008-e7fb562d11f8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1649&q=80')">
            <div>
                <div class="text-5xl font-black mx-auto text-yellow-400 rounded-lg">{{ __('Inform. Inspire. Change.') }}</div>
                <div class="text-base font-semibold text-white py-4 rounded-lg">{{ __('Quickly publish your shows, and distribute them on big podcast players, such as Spotify, Apple Podcasts, and Google Podcasts.') }}</div>
                <a  href="{{ route('register') }}"
                    class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-blueGray-900 uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:border-yellow-500 focus:shadow-outline-yellow disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __("Get Started") }}
                </a>
            </div>
        </div>

        {{-- Getting Started Articles --}}
        <div class="mt-24 grid grid-cols-2 gap-8 items-center">
            <div class="col-span-2 sm:col-span-1 prose">
                <h1 class="text-blueGray-800">{{ __("Want to create a podcast but don't know where to start?") }}</h1>
                <p class="text-blueGray-600">{{ __("We have written some useful guides to help you get started. If you still have any questions, let us know. We will be more than happy to assist.") }}</p>
                <a  href="{{ route('help') }}"
                    class="inline-flex items-center no-underline px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-blueGray-900 uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:border-yellow-500 focus:shadow-outline-yellow disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __("Learn more") }}
                </a>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <img src="{{ asset("images/undraw_To_the_stars_qhyy.svg") }}" alt="undraw To the stars qhyy" class="">
            </div>
        </div>
    </div>
@endsection
