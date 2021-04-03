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

            {{-- Filter Forms --}}
            {{-- <div class="flex items-center justify-end">
                <label
                    for="date_filter"
                    class="font-bold text-gray-600 mr-2 text-sm"
                >
                    {{ __('Filter by') }}
                </label>
                <div class="sm:w-1/4 ml-2">
                    <select wire:model="dateRangeFilter" class="text-sm">
                        <option value="">
                            {{ __('Recent Reproductions') }}
                        </option>
                        <option value="range">
                            {{ __('Reproductions In A Range') }}
                        </option>
                    </select>
                </div> --}}

                {{-- Date Range Chooser --}}
                {{-- @if ($dateRangeFilter == 'range')

                    <form action="">
                        <div class="flex items-center">
                            <input type="date" wire:model="dateFrom" class="text-sm mx-2">
                            {{ __('to') }}
                            <input type="date" wire:model="dateTo" class="text-sm ml-2">
                        </div>
                    </form>

                @endif
            </div>

            <div>
                {{ $getMtdDailyReproductions }}
            </div> --}}

            <div class="bg-white inline-block p-6 shadow rounded-xl">

                <div class="">
                    {{-- Average total reproductions per episode --}}
                    {{--
                        IN QUERY:
                        1. Find total views of episodes 7, 30, 60, and 90 days after the episodes are published
                        2. Calculate average for each query

                        RENDER RESULT AS JSON
                    --}}
                    <div class="text-left">
                        <div class="font-semibold text-base">
                            {{__('Average Reproductions per episode')}}
                        </div>
                        <div class="text-xs text-gray-600">
                            {{ __('7, 30, 60, and 90 days after publishing date.') }}
                        </div>
                    </div>

                    <div class="border-t my-4"></div>

                    <div class="flex space-x-8">
                        <div class="flex-row space-y-6">

                            <div class="text-center">
                                <div class="text-indigo-600 font-semibold">
                                    {{ $totalPlaySevenDaysAfter }}
                                </div>
                                <div class="text-sm text-gray-600 font-semibold capitalize">
                                    {{ __('First 7 days') }}
                                </div>
                            </div>
                            <div class="border-t"></div>

                            <div class="text-center">
                                <div class="text-indigo-600 font-semibold">
                                    {{ $totalPlayThirtyDaysAfter }}
                                </div>
                                <div class="text-sm text-gray-600 font-semibold capitalize">
                                    {{ __('First 30 days') }}
                                </div>
                            </div>
                        </div>

                        <div class="border-l"></div>

                        <div class="flex-row space-y-6">

                            <div class="text-center">
                                <div class="text-indigo-600 font-semibold">
                                    {{ $totalPlaySixtyDaysAfter }}
                                </div>
                                <div class="text-sm text-gray-600 font-semibold capitalize">
                                    {{ __('First 60 days') }}
                                </div>
                            </div>
                            <div class="border-t"></div>

                            <div class="text-center">
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

            </div>


            {{-- Table --}}
            <div class="flex flex-col my-6">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="my-2">
                            <h3 class="font-bold text-gray-700 mb-0">
                                {{ __('Episode breakdown') }}
                            </h3>
                            <small class="mt-1">
                                {{ __('Downloads per episode since being published.') }}
                            </small>
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
                                                <div class="text-sm text-gray-900">{{ $rbe->title }}</div>
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
                    </div>
                </div>
            </div>

            {{-- <div class="text-center text-gray-800 font-light my-6">
                {{ __('No data found in the past 30 days.') }}
            </div> --}}

        </div>
    </div>
</div>
