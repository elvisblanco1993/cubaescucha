<div>
    <div class="text-4xl font-semibold">
        {{ __("Confirm your selection") }}
    </div>
    <div class="mt-4">
        {{__("Check to make sure you've chosen the right feed.")}}
    </div>

    <div class="mt-8 grid grid-cols-3 gap-8">
        <div class="col-span-1 rounded-lg shadow p-6 bg-white">
            <img src="{{ $podcast_thumbnail }}" class="rounded-lg border mx-auto">

            <p class="text-sm text-slate-600 my-2">
                <span class="block text-green-600 mb-1">{{ __("TITLE") }}</span>
                {{ $podcast_name }}
            </p>

            <p class="text-sm text-slate-600 mt-4">
                <span class="block text-green-600 mb-1">{{ __("DESCRIPTION") }}</span>
                {{ Str::limit($podcast_description, 250, '...') }}
            </p>
        </div>

        <div class="col-span-2 rounded-lg shadow bg-white">
            <ul class="p-6 text-sm">
                @forelse ($data as $item)
                    <li class="flex items-center justify-between py-4 border-b">
                        <div class="">
                            {{$item['title']}}
                        </div>
                        <div class="text-gray-500">
                            {{$item['pubDate']}}
                        </div>
                    </li>
                @empty

                @endforelse
            </ul>
            <div class="px-6 mb-6 text-xs text-gray-500">{{ __("Showing 8 out of " . $episodes_count) }}</div>
        </div>
    </div>

    <div class="mt-24 flex items-center justify-end gap-8">
        <a href="{{ route('podcasts') }}" class="text-sm text-gray-500">{{ __("Cancel") }}</a>

        <x-jet-button wire:click="confirmOwnership">
            Next step
        </x-jet-button>
    </div>
</div>
