<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items--center justify-between">
            <div class="flex items-center text-gray-500">
                <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
                <span class="mx-1">/</span>
                <a class="text-indigo-500" href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}">{{ $podcast->name }}</a>
                <span class="mx-1">/</span>
                <span>{{ $episode->title }}</span>
            </div>
            <a href="{{ url()->previous() }}" class="flex text-sm items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                {{__("Go back")}}
            </a>
        </div>
    </div>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Episode details') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('In this window you can see all retails related to this particular episode. You can also edit the episode\'s title, description, or even upload a new audio file.') }}
                            </p>

                            <p class="mt-6">{{ __('Preview') }}</p>
                            <audio controls class="block w-full mt-2 rounded-lg" controlsList="nodownload">
                                <source src="{{ Storage::disk('s3')->url($episode->file_name) }}" type="audio/mpeg">
                            </audio>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        @livewire('episode.edit', ['podcast' => $podcast, 'episode' => $episode])
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
