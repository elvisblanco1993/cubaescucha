<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-gray-500">
            <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
            <span class="mx-1">/</span>
            <a class="text-indigo-500" href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}">{{ $podcast->name }}</a>
            <span class="mx-1">/</span>
            <span>{{ __('New episode') }}</span>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('New Episode') }}
                            </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Time to publish another episode I see.
                        </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        @livewire('episode.create', ['podcast' => $podcast])
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
