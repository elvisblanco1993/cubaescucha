@extends('layouts.web')
@section('content')
    <script src="https://js.stripe.com/v3"></script>
    <div class="bg-blueGray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Title Bar --}}
            <div class="w-full flex justify-between items-center">
                <div class="text-2xl font-light text-white">
                    {{ __("Become a sponsor to cubaescucha.com") }}
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

    <div class="max-w-7xl mx-auto my-4 px-4 sm:px-6 lg:px-8 py-8 prose">
        <p>
            {{__("Cubaescucha is a podcasting platform that allows creators share their content in audio format, and distribute it throughout the biggest podcast players, such as Spotify, Apple Podcasts, and Google Podcasts. While the platform is 100% FREE for both creators and listeners, servers maintenance and development comes at a cost. If you would like to help keep the lights up (and feed our cats), please consider becoming a sponsor with your monthly contribution, or make a on-time donation using the options below. ")}}
        </p>

        <div class="bg-white rounded-lg shadow px-4 sm:px-6 lg:px-8 py-8 flex items-centers justify-between">
            <div class="">
                <strong>
                    {{ __("Your donation to cubaescucha.com") }}
                </strong>
                <span class="ml-8">${{ $total }}.00 {{__("monthly")}}</span>
            </div>
            <div>
                {{ $checkout->button('Continue to Payment', ['class' => 'inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-blueGray-900 uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:border-yellow-500 focus:shadow-outline-yellow disabled:opacity-25 transition ease-in-out duration-150']) }}
            </div>
        </div>
        <small>{{ __("You can cancel your sponsorship at any given time from your Billing Portal.") }}</small>
    </div>
@endsection
