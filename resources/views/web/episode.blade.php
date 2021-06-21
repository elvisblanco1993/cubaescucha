@extends('layouts.web')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

    <div class="sm:flex gap-8">

        {{-- Left side --}}
        <div class="w-full sm:w-1/3">
            <img src="{{ Storage::disk('s3')->url($podcast->thumbnail) }}" class="block rounded-lg object-cover object-center">

            @livewire('player.episode.play', ['episode' => $episode])

        </div>

        {{-- Right side --}}
        <div class="w-full sm:w-2/3">

            <h1 class="text-4xl font-extrabold">
                {{ $episode->title }}
            </h1>
            <a href="{{ route('podcast.display', ['podcast' => $podcast->url]) }}" class="font-bold text-base text-indigo-500">
                {{ $podcast->name }}
            </a>
            <small class="block text-blueGray-800 my-4 capitalize">
                {{ $podcast->tags }}
            </small>

            <div class="my-4 flex gap-2">
                <a  href="{{ route('genRss', ['podcast' => $podcast->url]) }}"
                    target="_blank"
                    class="border p-1 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z" />
                    </svg>
                </a>

                @isset($podcast->spotifypodcasts_url)
                    <a href="{{ $podcast->potifypodcasts_url }}"
                        target="_blank"
                        class="border p-1 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" version="1.1" viewBox="0 0 168 168">
                            <path fill="#1ED760" d="m83.996 0.277c-46.249 0-83.743 37.493-83.743 83.742 0 46.251 37.494 83.741 83.743 83.741 46.254 0 83.744-37.49 83.744-83.741 0-46.246-37.49-83.738-83.745-83.738l0.001-0.004zm38.404 120.78c-1.5 2.46-4.72 3.24-7.18 1.73-19.662-12.01-44.414-14.73-73.564-8.07-2.809 0.64-5.609-1.12-6.249-3.93-0.643-2.81 1.11-5.61 3.926-6.25 31.9-7.291 59.263-4.15 81.337 9.34 2.46 1.51 3.24 4.72 1.73 7.18zm10.25-22.805c-1.89 3.075-5.91 4.045-8.98 2.155-22.51-13.839-56.823-17.846-83.448-9.764-3.453 1.043-7.1-0.903-8.148-4.35-1.04-3.453 0.907-7.093 4.354-8.143 30.413-9.228 68.222-4.758 94.072 11.127 3.07 1.89 4.04 5.91 2.15 8.976v-0.001zm0.88-23.744c-26.99-16.031-71.52-17.505-97.289-9.684-4.138 1.255-8.514-1.081-9.768-5.219-1.254-4.14 1.08-8.513 5.221-9.771 29.581-8.98 78.756-7.245 109.83 11.202 3.73 2.209 4.95 7.016 2.74 10.733-2.2 3.722-7.02 4.949-10.73 2.739z"/>
                        </svg>
                    </a>
                @endisset

                @isset($podcast->applepodcasts_url)
                    <a href="{{ $podcast->applepodcasts_url }}"
                        target="_blank"
                        class="border p-1 rounded-lg">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M267.429 488.563C262.286 507.573 242.858 512 224 512c-18.857 0-38.286-4.427-43.428-23.437C172.927 460.134 160 388.898 160 355.75c0-35.156 31.142-43.75 64-43.75s64 8.594 64 43.75c0 32.949-12.871 104.179-20.571 132.813zM156.867 288.554c-18.693-18.308-29.958-44.173-28.784-72.599 2.054-49.724 42.395-89.956 92.124-91.881C274.862 121.958 320 165.807 320 220c0 26.827-11.064 51.116-28.866 68.552-2.675 2.62-2.401 6.986.628 9.187 9.312 6.765 16.46 15.343 21.234 25.363 1.741 3.654 6.497 4.66 9.449 1.891 28.826-27.043 46.553-65.783 45.511-108.565-1.855-76.206-63.595-138.208-139.793-140.369C146.869 73.753 80 139.215 80 220c0 41.361 17.532 78.7 45.55 104.989 2.953 2.771 7.711 1.77 9.453-1.887 4.774-10.021 11.923-18.598 21.235-25.363 3.029-2.2 3.304-6.566.629-9.185zM224 0C100.204 0 0 100.185 0 224c0 89.992 52.602 165.647 125.739 201.408 4.333 2.118 9.267-1.544 8.535-6.31-2.382-15.512-4.342-30.946-5.406-44.339-.146-1.836-1.149-3.486-2.678-4.512-47.4-31.806-78.564-86.016-78.187-147.347.592-96.237 79.29-174.648 175.529-174.899C320.793 47.747 400 126.797 400 224c0 61.932-32.158 116.49-80.65 147.867-.999 14.037-3.069 30.588-5.624 47.23-.732 4.767 4.203 8.429 8.535 6.31C395.227 389.727 448 314.187 448 224 448 100.205 347.815 0 224 0zm0 160c-35.346 0-64 28.654-64 64s28.654 64 64 64 64-28.654 64-64-28.654-64-64-64z"/>
                        </svg>
                    </a>
                @endisset

                @isset($podcast->googlepodcasts_url)
                    <a href="{{ $podcast->googlepodcasts_url }}"
                        target="_blank"
                        class="border p-1 rounded-lg">
                        <svg class="w-6 h-6" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 122.88" style="enable-background:new 0 0 122.88 122.88" xml:space="preserve">
                            <style type="text/css">.st0{fill:#0066D9;} .st1{fill:#4285F4;} .st2{fill:#EA4335;} .st3{fill:#34A853;} .st4{fill:#FAB908;}</style>
                            <g>
                                <path class="st0" d="M15.36,57.25v8.38c0,4.24-3.44,7.68-7.68,7.68S0,69.87,0,65.63v-8.38c0-4.24,3.44-7.68,7.68-7.68 S15.36,53.01,15.36,57.25L15.36,57.25z"></path>
                                <path class="st1" d="M107.52,57.47c0-0.07,0-0.15,0-0.22c0-4.24,3.44-7.68,7.68-7.68c4.24,0,7.68,3.44,7.68,7.68 c0,0.07,0,0.15,0,0.22l0,0v8.38h0c-0.12,4.14-3.51,7.46-7.68,7.46s-7.56-3.32-7.68-7.46h0L107.52,57.47L107.52,57.47L107.52,57.47 L107.52,57.47z"></path>
                                <path class="st2" d="M41.89,82.39v8.38c0,4.24-3.44,7.68-7.68,7.68c-4.24,0-7.68-3.44-7.68-7.68v-8.38c0-4.24,3.44-7.68,7.68-7.68 C38.45,74.71,41.89,78.14,41.89,82.39L41.89,82.39L41.89,82.39z M41.89,32.12v27.4h0c-0.09,4.16-3.49,7.51-7.68,7.51 c-4.18,0-7.58-3.34-7.68-7.51h0v-27.4c0-4.24,3.44-7.68,7.68-7.68S41.89,27.87,41.89,32.12L41.89,32.12L41.89,32.12z"></path>
                                <path class="st3" d="M80.99,40.49c0,4.24,3.44,7.68,7.68,7.68s7.68-3.44,7.68-7.68v-8.38c0-4.24-3.44-7.68-7.68-7.68 c-4.24,0-7.68,3.44-7.68,7.68V40.49L80.99,40.49z"></path>
                                <path class="st4" d="M53.76,16.06c0,4.24,3.44,7.68,7.68,7.68s7.68-3.44,7.68-7.68V7.68c0-4.24-3.44-7.68-7.68-7.68 s-7.68,3.44-7.68,7.68V16.06L53.76,16.06z M53.76,106.82c0-4.24,3.44-7.68,7.68-7.68s7.68,3.44,7.68,7.68v8.38 c0,4.24-3.44,7.68-7.68,7.68s-7.68-3.44-7.68-7.68V106.82L53.76,106.82z"></path>
                                <path class="st3" d="M80.99,63.53c0-4.24,3.44-7.68,7.68-7.68s7.68,3.44,7.68,7.68v27.23c0,4.24-3.44,7.68-7.68,7.68 c-4.24,0-7.68-3.44-7.68-7.68V63.53L80.99,63.53z"></path>
                                <path class="st4" d="M69.12,39.1v44.68c0,4.24-3.44,7.68-7.68,7.68s-7.68-3.44-7.68-7.68V39.1c0-4.24,3.44-7.68,7.68-7.68 S69.12,34.86,69.12,39.1L69.12,39.1z"></path>
                            </g>
                        </svg>
                    </a>
                @endisset
            </div>

            <div class="prose">
                @parsedown($episode->show_notes)
            </div>

        </div>

    </div>

</div>

@endsection
