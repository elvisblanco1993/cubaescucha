<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center font-semibold text-lg text-gray-600 leading-tight">
                    {{__("Podcasts")}}
                </div>

                <div class="flex items-center gap-8 -my-2">
                    <x-jet-secondary-button onclick="window.location.href='{{ route('podcasts.import') }}'" title="Import podcast.">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                        <span class="hidden sm:flex sm:ml-2">
                            {{ __("Import Podcast") }}
                        </span>
                    </x-jet-secondary-button>
                    <x-jet-button onclick="window.location.href='{{ route('podcasts.create') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="hidden sm:flex sm:ml-2">
                            {{ __('Create Podcast') }}
                        </span>
                    </x-jet-button>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-5xl mx-auto my-12 px-4 sm:px-6 lg:px-8">

        @if ($podcasts->count() == 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">

            </div>
        @else

        <div class="grid grid-cols-4 gap-8 px-4 sm:px-0 my-6">

            @forelse ($podcasts as $podcast)

                <a href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}" class="col-span-2 md:col-span-1 border rounded-xl hover:shadow">
                    <img src="{{ Storage::disk('s3')->url($podcast->thumbnail) }}" alt="{{ $podcast->name }}" class="rounded-t-xl rounded-b-none object-cover w-full h-48">
                    <div class="px-4 py-4">
                        <div class="text-base font-bold">
                            {{ $podcast->name }}
                        </div>
                    </div>
                </a>

            @empty

            @endforelse
        </div>
        @endif
    </div>

</x-app-layout>
