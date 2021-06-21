@extends('layouts.web')
@section('content')
    <div class="bg-blueGray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Title Bar --}}
            <div class="w-full flex justify-between items-center">
                <div class="text-2xl font-light text-white">
                    {{__("Need help using cubaescucha?")}}
                </div>
                <a href="{{ config('app.url') }}" class="text-sm text-blueGray-400 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    {{ __("Go back") }}
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Guides --}}
        <div class="w-full">
            <a href="#">
                <div class="bg-white shadow hover:shadow-lg transition-shadow duration-100 rounded-md p-8 my-8 flex items-center">
                    <div class="pr-3 mr-3 border-r">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blueGray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <div class="">
                        <div class="text-lg font-light">
                            {{__("Getting Started")}}
                        </div>
                        <div class="text-sm font-light">
                            {{__("How to use the cubaescucha platform.")}}
                        </div>
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="bg-white shadow hover:shadow-lg transition-shadow duration-100 rounded-md p-8 my-8 flex items-center">
                    <div class="pr-3 mr-3 border-r">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blueGray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" /></svg>
                    </div>
                    <div class="">
                        <div class="text-lg font-light">
                            {{__("Podcast Production")}}
                        </div>
                        <div class="text-sm font-light">
                            {{__("Some advice on recording and editing your episodes.")}}
                        </div>
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="bg-white shadow hover:shadow-lg transition-shadow duration-100 rounded-md p-8 my-8 flex items-center">
                    <div class="pr-3 mr-3 border-r">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blueGray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z" /></svg>
                    </div>
                    <div class="">
                        <div class="text-lg font-light">
                            {{__("Distribute your Podcast")}}
                        </div>
                        <div class="text-sm font-light">
                            {{__("Learn how to submit your podcast to directories, and reach a broader audience.")}}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection
