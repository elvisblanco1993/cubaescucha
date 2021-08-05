@extends('layouts.web')
@section('content')
<div class="w-full mx-auto px-0">
    <div class="h-full max-w-5xl text-black mx-auto flex items-center justify-center relative">

        <div class="absolute w-36 h-36 sm:w-72 sm:h-72 mr-48 sm:mr-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob z-0"></div>
        <div class="absolute w-36 h-36 sm:w-72 sm:h-72 ml-48 sm:ml-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-blob animation-delay-2000 z-0"></div>
        <div class="absolute w-36 h-36 sm:w-72 sm:h-72 mt-8 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-60 animate-blob animation-delay-4000 z-0"></div>

        <div class="max-w-5xl mx-auto py-48 px-4 sm:px-6 lg:px-8 mt-8 sm:text-center z-10">
            <div class="text-5xl font-black text-bluegray-800 rounded-lg">{{ __('Inform. Inspire. Change.') }}</div>
            <div class="max-w-3xl text-xl font-semibold text-bluegray-800 py-4">{{ __('voicebits.co is the simplest professional podcasting platform.') }}</div>
        </div>
    </div>
</div>

<div class="w-full bg-bluegray-200">
    <div class="max-w-5xl mx-auto grid grid-cols-2 items-center gap-12 px-4 sm:px-6 lg:px-8 py-24 md:py-44 prose">
        <div class="col-span-2 sm:col-span-1">
            <img src="{{ asset('storage/soundtrap-n30_i7mx62o-unsplash.jpg') }}" alt="" class="rounded-xl">
        </div>
        <div class="col-span-2 sm:col-span-1">
            <h1>
                {{ __("Host your show with voicebits.co") }}
            </h1>
            <p class="font-semibold text-bluegray-800">
                {{ __("Use our advanced platform to create, distribute and grow your podcasts. Get published on Spotify, Apple Podcasts, Google Podcasts and more with ease. voicebits makes launching your next show easy, so that you can focus on creating awesome content.") }}
            </p>

            <x-jet-button onclick="window.location.href='{{ route('register') }}'">
                {{ __("Get Started") }}
            </x-jet-button>
        </div>
    </div>
</div>

@if (\App\Models\Podcast::whereNotNull('is_public')->count() > 0)
<div class="w-full bg-white">
    <div class="max-w-5xl mx-auto grid grid-cols-3 items-center gap-12 px-4 sm:px-6 lg:px-8 py-24">
        <div class="col-span-3 mx-auto">
            <h1 class="text-bluegray-900 font-black text-4xl capitalize">{{ __("Latest shows") }}</h1>
        </div>

        @forelse (\App\Models\Podcast::whereNotNull('is_public')->get() as $show)
            <div class="col-span-3 sm:col-span-1">
                <div class="pb-2 rounded-lg shadow hover:shadow-md hover:cursor-pointer">
                    <a href="">
                    <img src="{{ Storage::disk('s3')->url($show->thumbnail) }}" alt="{{ $show->name }}" class="rounded-t-lg h-64 sm:h-48 w-full object-cover">
                    <div class="mx-2 my-2 text-sm font-semibold text-bluegray-800">
                        {{ $show->name }}
                        </div>
                        <div class="mx-2 border-b"></div>
                        <div class="mx-2 my-2 text-xs font-medium text-bluegray-600">
                            {{ $show->team->name }}
                        </div>
                    </a>
                </div>
            </div>
        @empty

        @endforelse

        <div class="col-span-3 mx-auto prose">
            <a href="{{ route('shows') }}">
                {{ __("Discover more") }}
            </a>
        </div>
    </div>
</div>
@endif
@endsection
