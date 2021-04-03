<div>

    <div class="sm:flex items-center gap-6" wire:poll>

        {{-- MTD Card --}}
        <div class="bg-white shadow-sm rounded-xl text-center w-full sm:w-1/2 md:w-1/3 flex items-center justify-center my-6 sm:my-0 py-6">

            <div>
                <p class="text-sm mb-2 text-gray-600 uppercase">
                    {{ __('MTD Total Reproductions') }}
                </p>

                <h1 class="text-4xl md:text-5xl font-bold text-indigo-700">
                    {{ $mtdCounter }}
                </h1>
            </div>

        </div>

        {{-- Most active region --}}
        @if ( $countPerCountry->count() > 0 )
            <div class="bg-white shadow-sm rounded-xl text-center w-full sm:w-1/2 md:w-1/3 flex items-center justify-center my-6 sm:my-0 py-6">

                <div>
                    <p class="text-sm mt-1 text-gray-600 uppercase">
                        {{ __('Most active region') }}
                    </p>

                    <p>
                        {{ $countPerCountry[0]->country }}
                    </p>

                    <h1 class="text-4xl md:text-5xl font-bold text-indigo-700">
                        {{  $countPerCountry[0]->total }}
                    </h1>
                </div>

            </div>
        @endif

        {{-- Most Popular Episode --}}
        @if ($mostPopularEpisode->count() > 0)
            <div class="bg-white shadow-sm rounded-xl text-center w-full sm:w-1/2 md:w-1/3 flex items-center justify-center my-6 sm:my-0 py-6">

                <div>
                    <p class="text-sm mt-1 text-gray-600 uppercase">
                        {{ __('Most popular episode') }}
                    </p>

                    <p>
                        {{ $mostPopularEpisode[0]->title }}
                    </p>

                    <h1 class="text-4xl md:text-5xl font-bold text-indigo-700">
                        {{ $mostPopularEpisode[0]->total }}
                    </h1>

                </div>

            </div>
        @endif

    </div>

    {{-- <ul>
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
    </ul> --}}

</div>
