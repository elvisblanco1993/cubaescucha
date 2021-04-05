<div>
    {{-- In work, do what you enjoy. --}}
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-gray-500">
            <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
            <span class="mx-1">/</span>
            <a class="text-indigo-500" href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}">{{ $podcast->name }}</a>
            <span class="mx-1">/</span>
            <span>{{ __('Reports') }}</span>
        </div>
    </div>

    {{-- Content --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="md:flex gap-8">
                <div class="bg-white inline-block p-6 shadow rounded-xl w-full md:w-1/3">
                    <div>
                        <div class="text-left">
                            <div class="font-semibold text-base capitalize">
                                {{__('Total reproductions per episode')}}
                            </div>
                            <div class="text-xs text-gray-600">
                                {{ __('7, 30, 60, and 90 days after publishing date.') }}
                            </div>
                        </div>

                        <div class="border-t mt-4 mb-6"></div>

                        <div class="grid grid-cols-2 gap-12 text-center">

                            <div class="col-span-1">
                                <div class="text-indigo-600 font-semibold">
                                    {{ $totalPlaySevenDaysAfter }}
                                </div>
                                <div class="text-sm text-gray-600 font-semibold capitalize">
                                    {{ __('First 7 days') }}
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="text-indigo-600 font-semibold">
                                    {{ $totalPlayThirtyDaysAfter }}
                                </div>
                                <div class="text-sm text-gray-600 font-semibold capitalize">
                                    {{ __('First 30 days') }}
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="text-indigo-600 font-semibold">
                                    {{ $totalPlaySixtyDaysAfter }}
                                </div>
                                <div class="text-sm text-gray-600 font-semibold capitalize">
                                    {{ __('First 60 days') }}
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="text-indigo-600 font-semibold">
                                    {{ $totalPlayNinetyDaysAfter }}
                                </div>
                                <div class="text-sm text-gray-600 font-semibold capitalize">
                                    {{ __('First 90 days') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white inline-block p-6 shadow rounded-xl w-full md:w-2/3 mt-4 md:mt-0">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="text-left">
                                <div class="font-semibold text-base capitalize">
                                    {{__('Reproductions ranking by country')}}
                                </div>
                                <div class="text-xs text-gray-600">
                                    {{ __('Overall podcast reproductions since the podcast was first launched.') }}
                                </div>
                            </div>

                            <a href="{{ route('export-by-country', ['podcast' => $podcast->id]) }}"
                                    class="sm:float-right inline-flex justify-center items-center px-3 py-2 mb-4 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                    <svg class="w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    {{ __('Download') }}
                                </a>

                        </div>

                        <div class="border-t mt-4"></div>

                        <ul>
                            @forelse ($countPerCountry as $item)
                                <li class="flex items-center justify-between mb-1 py-1 border-b">
                                    <div class="text-gray-900 font-light capitalize">{{ $item->country }}</div>
                                    <div class="text-indigo-600 font-bold">{{ $item->total }}</div>
                                </li>
                            @empty

                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>


            {{-- Table --}}
            <div class="flex flex-col my-6">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="sm:flex my-2">
                            <div class="w-full sm:w-1/2">
                                <h3 class="font-bold text-gray-700 mb-0">
                                    {{ __('Episode breakdown') }}
                                </h3>
                                <small class="mt-1">
                                    {{ __('Downloads per episode since being published.') }}
                                </small>
                            </div>
                            <div class="w-full sm:w-1/2">
                                <a
                                    href="{{ route('export-by-episode', ['podcast' => $podcast->id]) }}"
                                    class="sm:float-right inline-flex justify-center items-center px-3 py-2 mb-4 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                    <svg class="w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    {{ __('Download') }}
                                </a>
                            </div>
                        </div>
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Title' )}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Published') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Total') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($reproductionsByEpisode as $rbe)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-light text-gray-900">{{ $rbe->title }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ date('M d, Y', strtotime($rbe->published)) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                {{ $rbe->total }}
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="my-6">
                            {{ $reproductionsByEpisode->links() }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="text-center text-gray-800 font-light my-6">
                {{ __('No data found in the past 30 days.') }}
            </div> --}}

        </div>
    </div>

</div>
