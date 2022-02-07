@extends('layouts.web')
@section('content')
    <header class="bg-white shadow">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-6">
                <div class="flex items-center font-semibold text-lg text-gray-800 leading-tight">
                    {{ __("Become a sponsor to voicebits.co") }}
                </div>

                <a href="{{ config('app.url') }}" class="text-sm text-slate-400 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    {{ __("Go back") }}
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-5xl mx-auto my-6 px-4 sm:px-6 lg:px-8 py-8 prose">
        <p>
            {{__("voicebits is a podcasting platform that allows creators share their content in audio format, and distribute it throughout the biggest podcast players, such as Spotify, Apple Podcasts, and Google Podcasts. While the platform is 100% FREE for both creators and listeners, servers maintenance and development comes at a cost. If you would like to help keep the lights up (and feed our cats), please consider becoming a sponsor with your monthly contribution, or make a on-time donation using the options below.")}}
        </p>

        @if (isset($success))
        <div class="px-4 sm:px-6 lg:px-8 py-4 bg-green-200 rounded-lg shadow-sm border-green-300 text-green-800">
            {{ $success }}
        </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div class="">
                <h3>
                    {{ __("Monthly") }}
                </h3>

                <div class="rounded border">
                    @guest
                        <div class="px-3 py-4 my-2">
                            <div class="flex items-center justify-between">
                                <strong>{{__("Login to see options")}}</strong>
                                <a href="{{ route("patron.plans") }}" class="no-underline text-slate-800 text-sm px-2 py-1 rounded border border-slate-300 shadow-sm">{{ __("Login") }}</a>
                            </div>
                        </div>
                    @endguest

                    @auth
                        @if (!Auth::user()->subscribed())
                            <div class="px-3 py-4 my-2">
                                <div class="flex items-center justify-between">
                                    <strong>{{__("$5 a month")}}</strong>
                                    <a href="{{ route('checkout', ['tier' => '1']) }}" class="no-underline text-slate-800 text-sm px-2 py-1 rounded border border-slate-300 shadow-sm">{{ __("Select") }}</a>
                                </div>
                            </div>

                            <div class="border-b"></div>

                            <div class="px-3 py-4 my-2">
                                <div class="flex items-center justify-between">
                                    <strong>{{__("$15 a month")}}</strong>
                                    <a href="{{ route('checkout', ['tier' => '2']) }}" class="no-underline text-slate-800 text-sm px-2 py-1 rounded border border-slate-300 shadow-sm">{{ __("Select") }}</a>
                                </div>
                            </div>

                            <div class="border-b"></div>

                            <div class="px-3 py-4 my-2">
                                <div class="flex items-center justify-between">
                                    <strong>{{__("$25 a month")}}</strong>
                                    <a href="{{ route('checkout', ['tier' => '3']) }}" class="no-underline text-slate-800 text-sm px-2 py-1 rounded border border-slate-300 shadow-sm">{{ __("Select") }}</a>
                                </div>
                            </div>

                            <div class="border-b"></div>

                            <div class="px-3 py-4 my-2">
                                <div class="flex items-center justify-between">
                                    <strong>{{__("$50 a month")}}</strong>
                                    <a href="{{ route('checkout', ['tier' => '4']) }}" class="no-underline text-slate-800 text-sm px-2 py-1 rounded border border-slate-300 shadow-sm">{{ __("Select") }}</a>
                                </div>
                            </div>
                        @else
                            <div class="px-3 py-4">
                                {{ __("You are already supporting us with your donation. To cancel your donation, or change it, please go to your") }} <a href="{{route('billing-portal')}}">{{__("Billing Portal")}}</a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="">
                <h3>
                    {{ __("One-time") }}
                </h3>

                <div class="rounded border">
                    <div class="px-3 py-4 my-2">
                        <div class="flex items-center justify-between">
                            <strong>$5.00 {{__("one time")}}</strong>
                            <a href="{{ config('donations.onetimedonation_5') }}" class="no-underline text-slate-800 text-sm px-2 py-1 rounded border border-slate-300 shadow-sm">{{ __("Select") }}</a>
                        </div>
                    </div>

                    <div class="border-b"></div>

                    <div class="px-3 py-4 my-2">
                        <div class="flex items-center justify-between">
                            <strong>$15.00 {{__("one time")}}</strong>
                            <a href="{{ config('donations.onetimedonation_15') }}" class="no-underline text-slate-800 text-sm px-2 py-1 rounded border border-slate-300 shadow-sm">{{ __("Select") }}</a>
                        </div>
                    </div>

                    <div class="border-b"></div>

                    <div class="px-3 py-4 my-2">
                        <div class="flex items-center justify-between">
                            <strong>$30.00 {{__("one time")}}</strong>
                            <a href="{{ config('donations.onetimedonation_30') }}" class="no-underline text-slate-800 text-sm px-2 py-1 rounded border border-slate-300 shadow-sm">{{ __("Select") }}</a>
                        </div>
                    </div>

                    <div class="border-b"></div>

                    <div class="px-3 py-4 my-2">
                        <div class="flex items-center justify-between">
                            <strong>$90.00 {{__("one time")}}</strong>
                            <a href="{{ config('donations.onetimedonation_90') }}" class="no-underline text-slate-800 text-sm px-2 py-1 rounded border border-slate-300 shadow-sm">{{ __("Select") }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sponsors --}}


@endsection
