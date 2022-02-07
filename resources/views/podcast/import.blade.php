<x-app-layout>
    <header class="border-b border-slate-100 bg-white">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-6">
                <div class="flex items-center font-semibold text-lg text-gray-900 leading-tight">
                    <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
                    <span class="mx-1">/</span>
                    <span>{{ __('Import Podcast') }}</span>
                </div>

                <a href="{{ route('podcasts') }}" class="flex text-sm items-center bg-slate-200 p-2 -m-2 rounded-lg hover:bg-slate-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <div class="my-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('podcast.import')
        </div>
    </div>
</x-app-layout>
