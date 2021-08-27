<div>
    {{-- Content --}}
    <div class="my-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-3 gap-8">

                <div class="col-span-3 bg-white inline-block p-6 shadow rounded-xl w-full">
                    <div class="font-semibold text-base capitalize mb-4">
                        {{__('MTD daily downloads')}}
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js" integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <canvas id="totalDownloads" width="400" height="100"></canvas>
                    <script>
                    var ctx = document.getElementById('totalDownloads');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [@forelse ( $getMtdDailyReproductions as $item)'{{ date('M d', strtotime($item->Day)) }}', @empty @endforelse],

                            datasets: [{
                                label: 'MTD Downloads',
                                data: [@forelse ( $getMtdDailyReproductions as $item){{ $item->total }}, @empty @endforelse],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',

                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: false
                                }
                            },
                            plugins: {
                                legend : {
                                    display: false
                                }
                            }
                        }
                    });
                    </script>

                </div>

                <div class="bg-white inline-block p-6 shadow rounded-xl w-full col-span-3 md:col-span-1">
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

                <div class="bg-white inline-block p-6 shadow rounded-xl w-full col-span-3 md:col-span-2 mt-4 md:mt-0">
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
            <div class="grid my-6">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-4 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="sm:flex my-2">
                            <div class="w-full sm:w-1/2">
                                <h3 class="font-bold text-gray-700 mb-0">
                                    {{ __('Episodes breakdown') }}
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
                                <thead class="bg-white">
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
