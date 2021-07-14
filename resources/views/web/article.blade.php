@extends('layouts.web')
@section('content')
    <div class="bg-black">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Title Bar --}}
            <div class="w-full flex justify-between items-center">
                <div class="text-2xl font-bold text-white">
                    {{__("Help & Support")}}
                </div>
                <a href="{{ route('help') }}" class="text-sm text-blueGray-400 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    {{ __("Go back") }}
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-4xl text-center font-bold text-blueGray-800 mb-8">
            {{ $article->title }}
        </div>
        <div class="prose mx-auto">
            @parsedown($article->body)
        </div>
    </div>
@endsection
