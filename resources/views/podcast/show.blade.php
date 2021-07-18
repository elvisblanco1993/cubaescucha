<x-app-layout>
    <div class="max-w-5xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-500 text-sm">
                <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
                <span class="mx-1">/</span>
                <span>{{ $podcast->name }}</span>
            </div>
            <a href="{{ route('podcasts') }}" class="flex text-sm items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                {{__("Go back")}}
            </a>
        </div>
    </div>

    <div class="py-4">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="md:flex mb-6 items-center">
                <div class="w-full md:w-1/4 rounded-t-2xl md:rounded-2xl bg-cover bg-center h-56" style="background-image: url('{{ Storage::disk('s3')->url($podcast->thumbnail) }}')"></div>
                <div class="w-full py-8 md:w-3/4 px-4 sm:px-12">
                    <div>
                        <h1 class="text-2xl font-extrabold">
                            {{ $podcast->name }}
                        </h1>
                        <div class="mt-6 flex">
                            <a href="{{ route('genRss', ['podcast' => $podcast->url]) }}" target="_blank" title="{{ __('RSS Feed') }}" class="mr-2 text-amber-500 hover:text-amber-600 p-2 bg-white rounded-lg shadow-sm hover:bg-amber-50">
                                <svg height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </a>

                            @if ($podcast->episodes->count() > 0)
                                <a href="{{ route('podcast.reports', ['podcast' => $podcast->id]) }}" title="{{ __('Reports') }}" class="mx-2 text-green-500 hover:text-green-600 p-2 bg-white rounded-lg shadow-sm hover:bg-green-50">
                                    <svg height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </a>
                            @endif

                            <a href="{{ route('podcasts.edit', ['podcast' => $podcast->id]) }}" title="{{ __('Edit podcast details') }}" class="mx-2 text-green-500 hover:text-green-600 p-2 bg-white rounded-lg shadow-sm hover:bg-green-50">
                                <svg height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-6">


                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('episode.create', ['podcast' => $podcast->id]) }}"
                        class=" inline-flex justify-center items-center px-3 py-2 mb-4 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                        <svg class="w-4 mr-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        {{ __('New episode') }}
                    </a>
                </div>

                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-4 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Episode' )}}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Published Date') }}
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">

                                    {{-- Episodes --}}
                                    @forelse ($episodes as $episode)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap flex items-center">
                                                <div class="mr-2 text-xs font-semibold flex items-center">
                                                    @if ($podcast->type == 'ews')
                                                    <div>
                                                        {{ 'S'.$episode->season }}
                                                    </div>
                                                    @endif
                                                    @if ($episode->episode_no)
                                                    <div class="">
                                                        {{ 'E' . $episode->episode_no }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="text-blueGray-500 text-sm">
                                                    {{ $episode->title }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blueGray-500">
                                                {{ date('M d, Y', strtotime($episode->published_at)) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('episode.show', ['podcast' => $podcast->id, 'episode' => $episode->id]) }}" class="text-indigo-600 hover:text-indigo-900">{{__('Edit')}}</a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
