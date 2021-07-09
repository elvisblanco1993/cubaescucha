<x-app-layout>
    {{-- Run the First Run walkthrough the first time the user enters the system, or when there are no podcasts created yet. --}}
    @if ($podcasts->count() == 0)
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session()->has('success'))
                <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div>

                <div>
                    <div class="sm:flex items-center justify-between py-2">
                        <p class="text-2xl font-bold uppercase">
                            {{ __('Hello, ') . Auth::user()->name . '!' }}
                        </p>

                        <div class="sm:flex items-center gap-8">
                            @livewire('podcast.import')
                            <a href="{{ route('podcasts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 my-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                {{ __('Create Podcast') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="my-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-blueGray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="{{ route('help') }}" class="underline text-gray-900 dark:text-white">{{__("Getting Started")}}</a>
                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{__("Cubaescucha has wonderful documentation and guides to help you get started. Whether you are a beginner or have experience with podcasting, cubaescucha helps you get the job done with ease.")}}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blueGray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold underline text-gray-900 dark:text-white">
                                    {{__("Support")}}
                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{__("We offer email-based support to all the creators on the platform, with a 12-hour maximum response time. We also offer live chat support for all our sponsors.")}}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-blueGray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="{{ config('app.url') . '/subscribe' }}" class="underline text-gray-900 dark:text-white">{{__("Newsletter")}}</a>
                                </div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{__("Keep up with the latest updates from cubaescucha. We constantly add new features, and apply fixes that help improve the overall platform experience for both you and your listeners.")}}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blueGray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"><a href="{{ config('app.url') . '/donate' }}" class="underline text-gray-900 dark:text-white">{{ __('Donate') }}</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{__("If you are enjoying cubaescucha, then please consider becoming a sponsor of the platform and automatically gain access to our live chat support channels. Your donation will help keep the lights up and will allow for the continued improvement of cubaescucha.")}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="sm:flex items-center justify-between py-2">
                <div class="flex items-center text-gray-500 text-sm">
                    <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
                </div>

                <div class="flex items-center gap-6 justify-center sm:justify-end">
                    @livewire('podcast.import')
                    <a href="{{ route('podcasts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        {{ __('Create Podcast') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

                @if (session()->has('success'))
                    <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-4 gap-8 px-4 sm:px-0">

                    @forelse ($podcasts as $podcast)

                        <a href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}" class="col-span-2 md:col-span-1 border rounded-xl hover:shadow">
                            <img src="{{ Storage::disk('s3')->url($podcast->thumbnail) }}" alt="{{ $podcast->name }}" class="rounded-t-xl rounded-b-none object-cover w-full h-48">
                            <div class="px-4 py-2">
                                <div class="text-base font-bold">
                                    {{ $podcast->name }}
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
