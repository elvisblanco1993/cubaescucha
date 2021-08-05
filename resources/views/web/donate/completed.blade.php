@extends('layouts.web')
@section('content')
    <script src="https://js.stripe.com/v3"></script>
    <div class="bg-black">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Title Bar --}}
            <div class="w-full flex justify-between items-center">
                <div class="text-2xl font-light text-white">
                    {{ __("Become a sponsor to voicebits.co") }}
                </div>
                <a href="{{ config('app.url') }}" class="text-sm text-blueGray-400 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    {{ __("Go Back") }}
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto my-6 px-4 sm:px-6 lg:px-8 py-8 prose">
        <p>
            {{__("voicebits is a podcasting platform that allows creators share their content in audio format, and distribute it throughout the biggest podcast players, such as Spotify, Apple Podcasts, and Google Podcasts. While the platform is 100% FREE for both creators and listeners, servers maintenance and development comes at a cost. If you would like to help keep the lights up (and feed our cats), please consider becoming a sponsor with your monthly contribution, or make a on-time donation using the options below. ")}}
        </p>

        <div class="bg-white rounded-lg shadow px-4 sm:px-6 lg:px-8 py-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <h1 class="uppercase text-green-400">{{__("Thank you for your support!")}}</h1>
            <div class="">
                <a href="/">{{ __("Go Home") }}</a>
            </div>
        </div>
        <small class="text-gray-400">{{__("Your donation has been successfully processed. You can download your receipt on your Billing Portal.")}}</small>
    </div>
@endsection
