<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center font-semibold text-lg text-gray-600 leading-tight">
                    <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
                    <span class="mx-1">/</span>
                    <a class="text-indigo-500" href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}">{{ $podcast->name }}</a>
                    <span class="mx-1">/</span>
                    <span>{{ __('Reports') }}</span>
                </div>

                <a href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}" class="flex text-sm items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    {{__("Go back")}}
                </a>
            </div>
        </div>
    </header>

    @livewire('podcast.reports', ['podcast' => $podcast->id])
</x-app-layout>
