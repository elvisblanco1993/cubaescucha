<x-app-layout>
    {{-- Run the First Run walkthrough the first time the user enters the system, or when there are no podcasts created yet. --}}
    @if ($podcasts->count() == 0)
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">

            {{-- Welcome to CubaEscucha --}}

            <div class="my-12">

                <div class="flex items-center justify-between">
                    <p class="text-2xl font-bold uppercase">
                        {{ __('Hello, ') . Str::substr(Auth::user()->name, 0, strpos(Auth::user()->name, " ")) . '!' }}
                    </p>

                    <a href="{{ route('podcasts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 my-2">
                        {{ __('Create Podcast') }}
                    </a>
                </div>

                <div class="mt-12 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-blueGray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">{{__("Getting Started")}}</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{__("Cubaescucha has wonderful documentation and guides to help you get started. Whether you are a beginner or have experience with podcasting, cubaescucha helps you get the job done with ease.")}}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-blueGray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laracasts.com" class="underline text-gray-900 dark:text-white">{{__("Support")}}</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{__("We offer email-based support to all creators on the platform, or wanting to migrate to cubaescucha with a 12-hour maximum response time. We also offer live chat support for all our contributors.")}}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-blueGray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel-news.com/" class="underline text-gray-900 dark:text-white">{{__("Newsletter")}}</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{__("Keep up with the latest updates from cubaescucha. We constantly ad new features, and apply fixes that help improve the overall platform experience for both you and your listeners.")}}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-blueGray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">{{__("Donate")}}</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{__("If you enjoy using cubaescucha, then consider becoming a patron of the platform and automatically gain access to our live chat support channels. Your donation will help keep the lights up and will allow for the continued improvement of cubaescucha.")}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
