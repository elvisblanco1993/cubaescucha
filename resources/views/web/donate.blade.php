@extends('layouts.web')
@section('content')
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
            {{__("Cubaescucha is a podcasting platform that allows creators share their content in audio format, and distribute it throughout the biggest podcast players, such as Spotify, Apple Podcasts, and Google Podcasts. While the platform is 100% FREE for both creators and listeners, servers maintenance and development comes at a cost. If you would like to help keep the lights up (and feed our cats), please consider becoming a sponsor with your monthly contribution, or make a on-time donation using the options below.")}}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div class="">
                <h3>
                    {{ __("Montly") }}
                </h3>

                <div class="rounded border">
                    @guest
                        <div class="px-3 py-2 my-2">
                            <div class="flex items-center justify-between">
                                <strong>{{__("Login to see options")}}</strong>
                                <a href="{{ route("patron.plans") }}" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Login") }}</a>
                            </div>
                        </div>
                    @endguest

                    @auth
                        <div class="px-3 py-2 my-2">
                            <div class="flex items-center justify-between">
                                <strong>{{__("$5 a month")}}</strong>
                                <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                            </div>
                        </div>

                        <div class="border-b"></div>

                        <div class="px-3 py-2 my-2">
                            <div class="flex items-center justify-between">
                                <strong>{{__("$8 a month")}}</strong>
                                <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                            </div>
                        </div>

                        <div class="border-b"></div>

                        <div class="px-3 py-2 my-2">
                            <div class="flex items-center justify-between">
                                <strong>{{__("$15 a month")}}</strong>
                                <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                            </div>
                        </div>

                        <div class="border-b"></div>

                        <div class="px-3 py-2 my-2">
                            <div class="flex items-center justify-between">
                                <strong>{{__("$25 a month")}}</strong>
                                <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                            </div>
                        </div>

                        <div class="border-b"></div>

                        <div class="px-3 py-2 my-2">
                            <div class="flex items-center justify-between">
                                <strong>{{__("$50 a month")}}</strong>
                                <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                            </div>
                        </div>

                        <div class="border-b"></div>

                        <div class="px-3 py-2 my-2">
                            <div class="flex items-center justify-between">
                                <div class="">
                                    <label class="text-sm">{{__("Custom amount")}}</label>
                                    <input type="number" class="text-sm" placeholder="$0.00">
                                </div>
                                <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                            </div>
                        </div>

                        @livewire('new-donation-subscription')
                    @endauth
                </div>
            </div>

            <div class="">
                <h3>
                    {{ __("One-time") }}
                </h3>

                <div class="rounded border">
                    <div class="px-3 py-2 my-2">
                        <div class="flex items-center justify-between">
                            <strong>{{__("$5 one time")}}</strong>
                            <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                        </div>
                    </div>

                    <div class="border-b"></div>

                    <div class="px-3 py-2 my-2">
                        <div class="flex items-center justify-between">
                            <strong>{{__("$10 one time")}}</strong>
                            <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                        </div>
                    </div>

                    <div class="border-b"></div>

                    <div class="px-3 py-2 my-2">
                        <div class="flex items-center justify-between">
                            <strong>{{__("$20 one time")}}</strong>
                            <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                        </div>
                    </div>

                    <div class="border-b"></div>

                    <div class="px-3 py-2 my-2">
                        <div class="flex items-center justify-between">
                            <strong>{{__("$50 one time")}}</strong>
                            <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                        </div>
                    </div>

                    <div class="border-b"></div>

                    <div class="px-3 py-2 my-2">
                        <div class="flex items-center justify-between">
                            <strong>{{__("$100 one time")}}</strong>
                            <a href="" class="no-underline text-blueGray-800 text-sm px-2 py-1 rounded border border-blueGray-300 shadow-sm">{{ __("Select") }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>



    {{-- Sponsors --}}


@endsection
