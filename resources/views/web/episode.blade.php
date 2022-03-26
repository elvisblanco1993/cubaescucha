@extends('layouts.podcast', ['name' => $podcast->name, 'description' => $podcast->description, 'thumbnail' => $podcast->thumbnail])
@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
        <div class="grid grid-cols-4 gap-8">
            <div class="col-span-4 sm:col-span-1">
                <a href="{{ route('podcast.display', ['podcast' => $podcast->url]) }}">
                    <img src="{{asset('covers/'.$podcast->thumbnail)}}" alt="" class="mx-auto sm:mx-0 w-44 h-44 object-cover rounded-md">
                </a>
            </div>
            <div class="col-span-4 sm:col-span-3 text-center sm:text-left">
                <div class="text-3xl sm:text-5xl font-black text-slate-800">{{$episode->title}}</div>
                <div class="mt-4 text-lg font-semibold text-slate-700">{{$podcast->name}}</div>
                <div class="mt-3">
                    <button
                        class="player-btn inline-block px-4 py-2 border-2 border-slate-600 hover:border-slate-800 hover:bg-slate-800 font-bold text-slate-600 hover:text-white transition-all"
                        id="playing{{$episode->id}}"
                        onclick="play({{$episode->id}}, '{{route('play_episode', ['podcast'=>$podcast->url, 'episode'=>$episode->file_name])}}', '{{$episode->title}}')">
                        {{__("PLAY EPISODE")}}
                    </button>
                    <a  href="{{route('play_episode', ['podcast'=>$podcast->url, 'episode'=>$episode->file_name])}}"
                        target="_blank"
                        class="ml-4 inline-block px-4 py-2 border-2 border-slate-600 hover:border-slate-800 hover:bg-slate-800 font-bold text-slate-600 hover:text-white transition-all">
                        {{__("DOWNLOAD EPISODE")}}
                    </a>
                </div>
            </div>
            <div class="col-span-4">
                <div class="text-lg text-justify font-normal">{{$episode->show_notes}}</div>
            </div>
        </div>
    </div>

    {{-- Player --}}
    @livewire('episode.player', ['podcast_id' => $podcast->id])
@endsection
