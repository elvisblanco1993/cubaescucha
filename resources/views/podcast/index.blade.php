<x-app-layout>
    {{-- Run the First Run walkthrough the first time the user enters the system, or when there are no podcasts created yet. --}}
    @if ($podcasts->count() == 0)
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">

            {{-- Welcome to CubaEscucha --}}

            <div class="my-12">

                <p class="text-2xl font-bold uppercase">
                    {{ __('Welcome, ') . Str::substr(Auth::user()->name, 0, strpos(Auth::user()->name, " ")) . '!' }}
                </p>

                <a href="{{ route('podcasts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 my-2">
                    {{ __('Create Podcast') }}
                </a>

            </div>
        </div>
    @else
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center text-gray-500">
                    <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
                </div>

                <a href="{{ route('podcasts.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 -my-2">{{ __('New Podcast') }}</a>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="w-full px-4 sm:px-0">

                    @forelse ($podcasts as $podcast)

                        <a href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}">
                            <div class="md:flex items-center bg-white rounded-2xl shadow-md hover:shadow-lg mb-12">
                                <div class="w-full md:w-1/4 h-64 rounded-t-2xl md:rounded-2xl bg-cover" style="background-image: url('{{ Storage::disk('s3')->url($podcast->thumbnail) }}')"></div>
                                <div class="w-full py-8 md:w-3/4 md:py-0 px-12">
                                    <h1 class="text-3xl font-bold">
                                        {{ $podcast->name }}
                                    </h1>
                                    <p class="text-gray-700 text-justify mt-4">
                                        @parsedown($podcast->description)
                                    </p>
                                </div>
                            </div>
                        </a>

                    @empty

                    @endforelse

                </div>

                <div class="mt-6">
                    {{ $podcasts->links() }}
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
