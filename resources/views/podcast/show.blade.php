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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-gray-50 border border-gray-300 rounded-lg p-6">
                <div class="sm:flex">
                    <div class="w-full sm:w-3/12">
                        <img src="{{ $thumbnail }}" class="rounded-lg shadow-lg">
                    </div>
                    <div class="w-full block mt-6 sm:mt-0 sm:w-9/12 sm:pl-8">
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

                        <div class="flex items-center mt-4">
                            <div class="text-sm pr-2 py-1 pl-2 bg-gray-100 border border-r-0 rounded-l border-gray-300 font-semibold text-gray-500 shadow-inner">
                                {{ __('RSS URL:') }}
                            </div>
                            <div class="text-sm border border-l-0 rounded rounded-l-none border-gray-300 bg-gray-50 text-gray-800 py-1 pl-2 pr-4 shadow-inner">
                                {{ asset('rss/'.$podcast->rss) }}
                            </div>
                        </div>

                        <div class="sm:flex sm:items-center sm:justify-end mt-6">
                            <div class="ml-6 mt-2 sm:my-0">
                                <a href="{{ route('podcast.display', ['podcast' => $podcast->slug]) }}"
                                    target="__blank"
                                    class="w-full inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                    <svg class="w-4 mr-2 text-indigo-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                        <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                        <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z"/>
                                    </svg>
                                    {{ __('View public site') }}
                                </a>
                            </div>

                            <div class="ml-6 mt-2 sm:my-0">
                                <a href="{{ route('episode.create', ['podcast' => $podcast->id]) }}"
                                    class="w-full inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                    <svg class="w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    {{ __('New episode') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Episodes --}}
            <div class="mt-12">

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

                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
