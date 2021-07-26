<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between py-6 border-b">
            <div class="flex items-center text-gray-500 text-sm">
                <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
                <span class="mx-1">/</span>
                <span>{{ __('New Podcast') }}</span>
            </div>


            <a href="{{ url()->previous() }}" class="flex text-sm items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                {{__("Go back")}}
            </a>
        </div>
    </div>

    <div class="mt-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @livewire('podcast.create')
        </div>
    </div>
</x-app-layout>
