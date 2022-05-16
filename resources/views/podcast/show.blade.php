<x-app-layout>

    <header class="border-b border-slate-100 bg-white">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-6">
                <div class="flex items-center font-semibold text-lg text-gray-900 leading-tight">
                    <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
                    <span class="mx-1">/</span>
                    <span>{{ $podcast->name }}</span>
                </div>

                <a href="{{ route('podcasts') }}" class="flex text-sm items-center bg-slate-200 p-2 -m-2 rounded-lg hover:bg-slate-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <div class="my-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="md:flex mb-6 items-center">
                <div class="w-full md:w-1/4 rounded-t-2xl md:rounded-2xl bg-cover bg-center h-56" style="background-image: url('{{ asset('covers/'.$podcast->thumbnail) }}')"></div>
                <div class="w-full py-8 md:w-3/4 px-4 sm:px-12">
                    <div>
                        <h1 class="text-2xl font-extrabold">
                            {{ $podcast->name }}
                        </h1>

                        <div class="text-sm font-semibold text-slate-600">
                            {{-- {{ __("Followers: ") . $podcast->followers->count() }} --}}
                        </div>

                        <div class="mt-6 flex">
                            <a href="{{ route('genRss', ['podcast' => $podcast->url]) }}" target="_blank" title="{{ __('RSS Feed') }}" class="flex text-sm text-slate-600 items-center bg-slate-200 p-2 mx-2 rounded-lg hover:bg-slate-300 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M5 3a1 1 0 000 2c5.523 0 10 4.477 10 10a1 1 0 102 0C17 8.373 11.627 3 5 3z" />
                                    <path d="M4 9a1 1 0 011-1 7 7 0 017 7 1 1 0 11-2 0 5 5 0 00-5-5 1 1 0 01-1-1zM3 15a2 2 0 114 0 2 2 0 01-4 0z" />
                                </svg>
                            </a>

                            <a href="{{ route('podcast.display', ['podcast' => $podcast->url]) }}" target="_blank" title="{{ __('Website') }}" class="flex text-sm text-slate-600 items-center bg-slate-200 p-2 mx-2 rounded-lg hover:bg-slate-300 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                                </svg>
                            </a>

                            @if ($podcast->episodes->count() > 0)
                                <a href="{{ route('podcast.reports', ['podcast' => $podcast->id]) }}" title="{{ __('Reports') }}" class="flex text-sm text-slate-600 items-center bg-slate-200 p-2 mx-2 rounded-lg hover:bg-slate-300 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                    </svg>
                                </a>
                            @endif

                            <a href="{{ route('podcasts.edit', ['podcast' => $podcast->id]) }}" title="{{ __('Edit podcast details') }}" class="flex text-sm text-slate-600 items-center bg-slate-200 p-2 mx-2 rounded-lg hover:bg-slate-300 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
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
                                                <div class="text-slate-500 text-sm">
                                                    {{ $episode->title }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
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
