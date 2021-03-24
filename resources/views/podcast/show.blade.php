<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-500">
                <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
                <span class="mx-1">/</span>
                <span>{{ $podcast->name }}</span>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="md:flex bg-white rounded-2xl shadow-sm mb-12 min-h-64">
                <div class="w-full md:w-1/4 rounded-t-2xl md:rounded-2xl bg-cover bg-center" style="background-image: url('{{ Storage::disk('s3')->url($podcast->thumbnail) }}')"></div>
                <div class="w-full py-8 md:w-3/4 px-4 sm:px-12">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-extrabold">
                            {{ $podcast->name }}
                        </h1>

                        <div class="flex align-baseline text-sm">
                            <a href="{{ route('podcasts.edit', ['podcast' => $podcast->id]) }}" class="mx-2 text-indigo-600 hover:text-indigo-800">
                                <svg class="w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                            @livewire('podcast.delete', ['podcast' => $podcast])
                        </div>
                    </div>
                    <p class="my-1 text-sm text-gray-600">By {{ $publisher->name }}</p>
                    <p>@parsedown($podcast->description)</p>

                    <div class="sm:flex items-center mt-4">
                        <div class="mr-6">
                            <a href="{{ route('genRss', ['podcast' => $podcast->slug]) }}" target="_blank" class="w-full inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                <svg class="w-4 mr-2 text-yellow-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"></path>
                                    <path d="M5.5 12a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-3-8.5a1 1 0 0 1 1-1c5.523 0 10 4.477 10 10a1 1 0 1 1-2 0 8 8 0 0 0-8-8 1 1 0 0 1-1-1zm0 4a1 1 0 0 1 1-1 6 6 0 0 1 6 6 1 1 0 1 1-2 0 4 4 0 0 0-4-4 1 1 0 0 1-1-1z"></path>
                                </svg>
                                {{__('RSS Feed')}}
                            </a>
                        </div>
                    </div>

                </div>
            </div>


            {{-- Tabs --}}
            <div>
                <div x-data="{ active: 'stats' }">

                    <div class="flex items-center justify-end">
                        <div class="inline-flex bg-white text-gray-500 rounded-full shadow-sm">
                            <button @click=" active = 'stats' " class="px-3 p1-2 rounded-xl m-1 border border-white" :class="{ 'bg-gray-100 text-indigo-600 border-indigo-200': active === 'stats' }">
                                {{ __('Statistics') }}
                            </button>

                            <button @click=" active = 'episodes' " class="px-3 p1-2 rounded-xl m-1 border border-white" :class="{ 'bg-gray-100 text-indigo-600 border-indigo-200': active === 'episodes' }">
                                {{ __('Episodes') }}
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-4 sm:p-12 mt-6 shadow-sm">

                        <div x-show="active === 'stats'">

                            {{-- Statistics Tab --}}
                            {{-- Show the statistics tab only after there are episodes on the podcast --}}
                            @if ($podcast->episodes->count() > 0)
                                @livewire('statistics.graphs', ['podcast' => $podcast->id])
                            @else
                                <div class="text-center">
                                    <a href="{{ route('episode.create', ['podcast' => $podcast->id]) }}"
                                        class="w-1/3 inline-flex justify-center items-center px-4 py-4 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                        <svg class="w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                        {{ __('New episode') }}
                                    </a>
                                </div>
                            @endif

                        </div>

                        <div x-show="active === 'episodes'">

                            {{-- Episodes Tab --}}
                            @forelse ($episodes as $episode)

                                <div class="flex items-center justify-between py-4 border-t border-gray-300">
                                    <div class="w-1/3">
                                        {{ $episode->title }}
                                        <small class="block uppercase text-gray-600">
                                            {{ $episode->type . ' episode / ' . date('M d, Y', strtotime($episode->created_at)) . " | S" .  $episode->season . ':E' . $episode->episode_no}}
                                        </small>
                                    </div>

                                    <div class="w-1/3">
                                        <audio controls controlsList="nodownload" class="rounded-lg w-full">
                                            <source src="{{ Storage::disk('s3')->url($episode->file_name) }}" type="audio/mpeg">
                                        </audio>
                                    </div>

                                    <div class="text-gray-400 text-sm">
                                        <a href="{{ route('episode.show', ['podcast' => $podcast->id, 'episode' => $episode->id]) }}" class="text-indigo-600 hover:text-indigo-900">View details</a>
                                    </div>
                                </div>

                            @empty

                                <div class="text-center">
                                    <a href="{{ route('episode.create', ['podcast' => $podcast->id]) }}"
                                        class="w-1/3 inline-flex justify-center items-center px-4 py-4 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                        <svg class="w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                        {{ __('New episode') }}
                                    </a>
                                </div>

                            @endforelse

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
