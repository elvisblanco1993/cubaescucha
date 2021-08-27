@extends('layouts.web')
@section('content')

<div class="x-full mx-auto px-0 bg-bluegray-900">
    <div class="h-full max-w-5xl text-white mx-auto grid grid-cols-2 items-center py-32 px-4 sm:px-6 lg:px-8">
        <div class="col-span-2 sm:col-span-1">
            <div class="text-5xl font-black text-white rounded-lg">{{ __('Inform. Inspire. Change.') }}</div>
            <div class="max-w-3xl text-xl font-semibold text-white mt-4">{{ __('Bring your next big show to the world with voicebits.co') }}</div>
            <div class="mt-8">
                <a href="{{ route('register') }}"
                   class="px-8 py-3 border border-bluegray-600 rounded-lg hover:bg-bluegray-800 hover:border-bluegray-500 transition"
                >
                    {{ __("Sign up") }}
                </a>
            </div>
        </div>
        <div class="col-span-2 sm:col-span-1 mt-8 sm:mt-0">
            <img src="{{ asset('storage/mic.png') }}" alt="" class="object-cover object-top">
        </div>
    </div>
</div>

<div class="w-full mx-auto px-0">
    <div class="h-full max-w-5xl text-bluegray-900 mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
        <div class="text-4xl font-black text-bluegray-900 rounded-lg">{{ __('Import your show') }}</div>
        <div class="text-xl font-semibold text-bluegray-900 mt-4">{{ __('Import your shows in a few simple steps.') }}</div>
        <img src="{{ asset('storage/articles/import_step_1.gif') }}" alt="" class="mx-auto md:max-w-4xl my-12 filter rounded-xl drop-shadow-lg">
    </div>

    <div class="h-full max-w-5xl text-bluegray-900 mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
        <div class="text-4xl font-black text-bluegray-900 rounded-lg">{{ __('Publish your podcasts anywhere') }}</div>
        <div class="text-xl font-semibold text-bluegray-900 mt-4">{{ __('You can seamesly distribute your podcasts in platforms such as Spotify, Google Podcasts, Apple Podcasts, among others.') }}</div>
        <img src="{{ asset('storage/distributors.svg') }}" alt="" class="mx-auto md:max-w-lg my-12 filter drop-shadow-lg">
    </div>
</div>
@endsection
