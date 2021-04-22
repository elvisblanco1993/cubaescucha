<div class="relative">
    {{-- Be like water. --}}
    <div class="mx-4 sm:mx-0">
        <input
        type="search"
        wire:model="query"
        placeholder="{{ __('Search') }}"
        accesskey="k"
        wire:keydown.escape="resetForm"
        class="sm:py-1"
    />
    </div>
    <div class="border-t border-gray-100 mt-6 sm:hidden"></div>

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
                {{ __('We could not find what you are looking for.') }}
            </div>
        @endif
    @endif

</div>
