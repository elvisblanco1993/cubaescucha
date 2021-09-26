@extends('layouts.web')
@section('content')

<div class="x-full mx-auto px-0 bg-bluegray-900">
    <div class="h-full max-w-5xl text-white mx-auto grid grid-cols-2 items-center py-36 sm:py-48 px-4 sm:px-6 lg:px-8">
        <div class="col-span-2 sm:col-span-1">
            <div class="text-5xl font-black text-white rounded-lg">{{ __('Inform. Inspire. Change.') }}</div>
            <div class="max-w-3xl text-xl font-semibold text-white mt-4">{{ __('Host your next big show with voicebits.co') }}</div>
            <div class="mt-8">
                <a href="{{ route('register') }}"
                   class="inline-block px-8 py-3 border border-bluegray-600 rounded-lg hover:bg-bluegray-800 hover:border-bluegray-500 transition"
                >
                    <div class="flex items-center gap-4">
                        {{ __("Free 14 Day Trial") }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>
        <div class="hidden sm:block col-span-2 sm:col-span-1 mt-8 sm:mt-0">
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
        <img src="{{ asset('storage/distributors.svg') }}" alt="" class="mx-auto max-w-sm my-12 filter drop-shadow-lg">
    </div>
</div>
@endsection
