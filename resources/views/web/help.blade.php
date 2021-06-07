@extends('layouts.web')
@section('content')
    <div class="bg-blueGray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Title Bar --}}
            <div class="w-full flex justify-between items-center">
                <div class="text-2xl font-light text-white">
                    Need help using cubaescucha?
                </div>
                <a href="{{ config('app.url') }}" class="text-sm text-blueGray-400 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    {{ __("Back to cubaescucha.com") }}
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Guides --}}
        <div class="w-full">
            <a href="#">
                <div class="bg-white shadow hover:shadow-lg transition-shadow duration-100 rounded-md p-8 my-8">
                    <div class="text-lg font-light">
                        Getting Started
                    </div>
                    <div class="text-sm font-light">
                        How to use the cubaescucha platform.
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="bg-white shadow hover:shadow-lg transition-shadow duration-100 rounded-md p-8 my-8">
                    <div class="text-lg font-light">
                        Podcast Production
                    </div>
                    <div class="text-sm font-light">
                        Some advice on recording and editing your episodes.
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="bg-white shadow hover:shadow-lg transition-shadow duration-100 rounded-md p-8 my-8">
                    <div class="text-lg font-light">
                        Distribute your Podcast
                    </div>
                    <div class="text-sm font-light">
                        Learn how to submit your podcast to directories, and reach a broader audience.
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection
