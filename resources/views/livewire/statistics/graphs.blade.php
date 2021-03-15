<div>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-500">
                <a class="text-indigo-500" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                <span class="mx-1">/</span>
                <select wire:model="podcastQuery" class="py-0 border-0">
                    <option value=""></option>

                    @forelse ($userPodcasts as $option)
                        <option class="px-1" value="{{ $option->id }}">{{ $option->name }}</option>
                    @empty
                        <option class="px-1" disabled>{{ __('Please create a podcast to start viewing some numbers.') }}</option>
                    @endforelse
                </select>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="sm:flex items-center justify-between gap-12">

            <div class="w-full sm:w-1/2">
                <div class="flex items-center justify-between bg-white p-6 h-48 shadow sm:rounded-lg border-t-4 border-indigo-400">
                    <div class="w-1/2">
                        <svg class="w-32 h-32 opacity-30" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                            <g id="XMLID_81_">
                                <g id="XMLID_393_">
                                    <path id="XMLID_433_" d="m256 350.502c46.317 0 84-37.682 84-84v-155.502c0-27.061-13.158-52.623-35.199-68.378-4.495-3.212-10.74-2.172-13.95 2.32-3.212 4.493-2.174 10.739 2.319 13.951 9.158 6.546 16.298 15.315 20.904 25.275h-19.074c-5.522 0-10 4.477-10 10s4.478 10 10 10h24.625c.244 2.258.375 4.537.375 6.832v13.168h-25c-5.522 0-10 4.477-10 10s4.478 10 10 10h25v20h-25c-5.522 0-10 4.477-10 10s4.478 10 10 10h25v20h-128v-20h25c5.522 0 10-4.477 10-10s-4.478-10-10-10h-25v-20h25c5.522 0 10-4.477 10-10s-4.478-10-10-10h-25v-13.168c0-2.295.131-4.574.375-6.832h24.625c5.522 0 10-4.477 10-10s-4.478-10-10-10h-19.078c4.638-10.03 11.846-18.849 21.101-25.412 4.505-3.195 5.566-9.437 2.371-13.942-3.194-4.504-9.436-5.566-13.941-2.372-22.2 15.746-35.453 41.374-35.453 68.558v155.502c0 46.318 37.683 84 84 84zm-64-126.334h128v42.334c0 35.29-28.71 64-64 64s-64-28.71-64-64z"/>
                                    <path id="XMLID_442_" d="m370 256.502c-5.522 0-10 4.477-10 10 0 57.346-46.654 104-104 104s-104-46.654-104-104c0-5.523-4.478-10-10-10s-10 4.477-10 10c0 58.032 40.074 106.873 94 120.323v34.269c-28.346 1.604-50.917 25.166-50.917 53.906 0 5.523 4.478 10 10 10h141.834c5.522 0 10-4.477 10-10 0-28.741-22.571-52.302-50.917-53.906v-34.269c53.926-13.45 94-62.291 94-120.323 0-5.523-4.478-10-10-10zm-54.583 208.498h-118.834c4.28-13.883 17.23-24 32.5-24h53.834c15.27 0 28.22 10.117 32.5 24zm-49.417-74.498v30.498h-20v-30.498z"/>
                                    <path id="XMLID_444_" d="m10 104.79c-5.522 0-10 4.477-10 10v130.168c0 5.523 4.478 10 10 10s10-4.477 10-10v-130.168c0-5.523-4.478-10-10-10z"/>
                                    <path id="XMLID_445_" d="m102 104.79c-5.522 0-10 4.477-10 10v130.168c0 5.523 4.478 10 10 10s10-4.477 10-10v-130.168c0-5.523-4.478-10-10-10z"/>
                                    <path id="XMLID_446_" d="m56 49.914c-5.522 0-10 4.477-10 10v239.92c0 5.523 4.478 10 10 10s10-4.477 10-10v-239.92c0-5.523-4.478-10-10-10z"/>
                                    <path id="XMLID_447_" d="m502 104.79c-5.522 0-10 4.477-10 10v130.168c0 5.523 4.478 10 10 10s10-4.477 10-10v-130.168c0-5.523-4.478-10-10-10z"/>
                                    <path id="XMLID_448_" d="m410 104.79c-5.522 0-10 4.477-10 10v130.168c0 5.523 4.478 10 10 10s10-4.477 10-10v-130.168c0-5.523-4.478-10-10-10z"/>
                                    <path id="XMLID_449_" d="m456 49.914c-5.522 0-10 4.477-10 10v239.92c0 5.523 4.478 10 10 10s10-4.477 10-10v-239.92c0-5.523-4.478-10-10-10z"/>
                                    <path id="XMLID_450_" d="m256 286.84c2.63 0 5.21-1.07 7.069-2.93 1.86-1.87 2.931-4.44 2.931-7.07s-1.07-5.21-2.931-7.08c-1.859-1.86-4.439-2.93-7.069-2.93s-5.21 1.07-7.07 2.93c-1.86 1.87-2.93 4.44-2.93 7.08 0 2.63 1.069 5.2 2.93 7.07 1.86 1.86 4.44 2.93 7.07 2.93z"/>
                                    <path id="XMLID_451_" d="m256.13 47c2.63 0 5.21-1.07 7.07-2.93 1.859-1.86 2.93-4.44 2.93-7.07s-1.07-5.21-2.93-7.07-4.44-2.93-7.07-2.93c-2.64 0-5.21 1.07-7.08 2.93-1.86 1.86-2.92 4.44-2.92 7.07s1.06 5.21 2.92 7.07c1.87 1.86 4.44 2.93 7.08 2.93z"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="w-1/2 text-right">
                        <h1 class="text-4xl md:text-5xl font-bold text-indigo-700">
                            {{ $mtdCounter }}
                        </h1>
                        <p class="text-sm mt-1 text-gray-600">
                            {{ __('MTD Total Reproductions') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="my-12 sm:my-0"></div>

            <div class="w-full sm:w-1/2">
                <div class="bg-white p-6 h-48 shadow sm:rounded-lg border-t-4 border-indigo-400">

                    @if ($podcastInfo)
                        <div>
                            <h3 class="text-4xl md:text-2xl font-bold text-emerald-400">{{ $podcastInfo->name }}</h3>
                            <div class="flex items-center justify-between py-2 border-t border-gray-200 mt-4">
                                <div>
                                    {{ __('Number of episodes') }}
                                </div>
                                <div>
                                    {{ $podcastInfo->episodes->count() }}
                                </div>
                            </div>
                            @if ($countPerCountry->count() > 0)
                                <div class="flex items-center justify-between py-2 border-t border-gray-200">
                                    <div>
                                        {{ __('Most active region') }}
                                    </div>
                                    <div>
                                        {{ $countPerCountry[0]->country . ' (' . $countPerCountry[0]->total . ')' }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="my-12"></div>

        <div class="flex items-center justify-between gap-12">
            <div class="w-full">
                <label class="mb-2 font-light text-gray-600">
                    {{ __('Reproductions per region') }}
                </label>
                <div class="bg-white p-6 shadow sm:rounded-lg border-t-4 border-indigo-400 mt-2">

                    <ul>
                        @forelse ($countPerCountry as $counter)
                            <li class="flex items-center justify-between bg-white py-2 @if(!$loop->first) border-t @endif border-indigo-200 @if($loop->last) rounded-b-lg @endif @if($loop->first) rounded-t-lg @endif">
                                <div>
                                    {{ $counter->country }}
                                </div>
                                <div>
                                    {{ $counter->total }}
                                </div>
                            </li>
                        @empty

                            <li class="bg-white py-2 list-none text-center">
                                {{ __('No enough data has been collected.') }}
                            </li>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>

        <div class="my-12"></div>

    </div>




































    {{-- <div class="flex justify-end mb-6">
        <div class="w-1/3">
            <select wire:model="podcastQuery">
                <option value=""></option>
                @forelse ($userPodcasts as $option)
                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                @empty
                    <option disabled>Please create at least one podcast to view statistics.</option>
                @endforelse
            </select>
        </div>
    </div> --}}

    {{-- <div class="max-w-7xl mx-auto px-4 sm:px-0">
        <div class="block w-full p-6 bg-indigo-100 border border-indigo-300 rounded-lg">
            @if ($countPerCountry->count() > 0)
                <div class="flex items-center justify-between">
                    <div class="w-full sm:w-1/2">
                        <div class="text-6xl text-indigo-800 font-extrabold">
                            {{ $mtdCounter }}
                        </div>
                        <p class="text-indigo-600 text-sm">
                            {{ __('MTD Overall Podcast Reproductions') }}
                        </p>
                    </div>
                    <div class="sm:w-1/2">
                        <svg class="w-32 h-32 transform rotate-45 text-indigo-300 float-right" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-earbuds" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6.825 4.138c.596 2.141-.36 3.593-2.389 4.117a4.432 4.432 0 0 1-2.018.054c-.048-.01.9 2.778 1.522 4.61l.41 1.205a.52.52 0 0 1-.346.659l-.593.19a.548.548 0 0 1-.69-.34L.184 6.99c-.696-2.137.662-4.309 2.564-4.8 2.029-.523 3.402 0 4.076 1.948zm-.868 2.221c.43-.112.561-.993.292-1.969-.269-.975-.836-1.675-1.266-1.563-.43.112-.561.994-.292 1.969.269.975.836 1.675 1.266 1.563zm3.218-2.221c-.596 2.141.36 3.593 2.389 4.117a4.434 4.434 0 0 0 2.018.054c.048-.01-.9 2.778-1.522 4.61l-.41 1.205a.52.52 0 0 0 .346.659l.593.19c.289.092.6-.06.69-.34l2.536-7.643c.696-2.137-.662-4.309-2.564-4.8-2.029-.523-3.402 0-4.076 1.948zm.868 2.221c-.43-.112-.561-.993-.292-1.969.269-.975.836-1.675 1.266-1.563.43.112.561.994.292 1.969-.269.975-.836 1.675-1.266 1.563z"/>
                          </svg>
                    </div>
                </div>

                <div class="w-full mt-6">
                    <p class="text-indigo-600 text-sm mb-1">
                        {{ __('Reproductions by country') }}
                    </p>
                    <ul>
                        @forelse ($countPerCountry as $counter)
                            <li class="flex items-center justify-between bg-white py-2 px-4 @if(!$loop->first) border-t @endif border-indigo-200 @if($loop->last) rounded-b-lg @endif @if($loop->first) rounded-t-lg @endif">
                                <div>
                                    {{ $counter->country }}
                                </div>
                                <div>
                                    {{ $counter->total }}
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            @else
                <div class="text-center text-lg text-indigo-800">
                    {{ __('Select a podcast to view some cool stats.') }}
                </div>
            @endif
        </div>
    </div> --}}
</div>
