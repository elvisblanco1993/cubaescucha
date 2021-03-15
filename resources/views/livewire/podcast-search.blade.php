<div class="relative">
    {{-- Be like water. --}}
    <input
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block py-1 w-full"
        type="search"
        wire:model="query"
        placeholder="{{ __('Search') }}"
        accesskey="k"
        wire:keydown.escape="resetForm"
    />

    @if (!empty($query))
        @if (!empty($podcasts))
            <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg rounded-b-lg border border-gray-200">

                @foreach ($podcasts as $podcast)
                    <a
                        href="{{ route('podcast.display', ['podcast' => $podcast['slug']]) }}"
                        class="block py-4 px-6 hover:bg-indigo-50 border-t border-gray-200 @if($loop->last) border-b-none rounded-b-lg @endif"
                    >
                        {{ $podcast['name'] }}
                    </a>
                @endforeach

            </div>
        @else
            <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                {{ __('No result') }}
            </div>
        @endif
    @endif

</div>
