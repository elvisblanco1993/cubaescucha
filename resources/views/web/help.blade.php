@extends('layouts.web')
@section('content')
    <div class="bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Title Bar --}}
            <div class="w-full flex justify-between items-center">
                <div class="text-2xl font-bold text-white">
                    {{__("Help & Support")}}
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
        <div class="w-full grid grid-cols-2 gap-8">
            @forelse ($articles as $article)
            <a href="{{ route('article-view', ['article' => $article->slug]) }}" class="col-span-2 md:col-span-1">
                <div class="bg-white shadow hover:shadow-lg transition-shadow duration-100 rounded-md p-8 flex items-center">
                    <div class="mr-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blueGray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        @if ($article->lang == 'es')
                            <span class="text-xs text-blue-600 font-light bg-blue-100 p-1 rounded-full">{{ __("ES") }}</span>
                        @else
                            <span class="text-xs text-green-600 font-light bg-green-100 p-1 rounded-full">{{ __("EN") }}</span>
                        @endif
                    </div>
                    <div class="">
                        <div class="text-xl font-semibold text-blueGray-800 mb-2">
                            {{ $article->title }}
                        </div>
                        <div class="text-sm text-blueGray-700 font-light">
                            {{$article->excerpt}}
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-2 p-8 bg-white text-center rounded-xl shadow text-lg">
                {{ __("There are no articles published at this time. Please come back later.") }}
            </div>
            @endforelse
        </div>
    </div>

@endsection
