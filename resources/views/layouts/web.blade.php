<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">

            {{-- Header bar --}}
            <div class="bg-white shadow-sm mb-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center w-full sm:w-1/6">
                            <a href="{{ route('home') }}">
                                <x-jet-application-mark class="block h-9 w-full" />
                            </a>
                        </div>

                        <div class="hidden sm:block sm:w-3/6">
                            @livewire('podcast-search')
                        </div>

                        {{-- Navigation Links --}}
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex uppercase">
                            @guest
                                <a href="{{ route('login') }}" :active="request()->routeIs('login')"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ __('Login') }}
                                </a>

                                <a href="{{ route('register') }}" :active="request()->routeIs('register')"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ __('Get Started') }}
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ __('Dashboard') }}
                                </a>
                            @endguest
                        </div>
                        {{-- End of Navigation --}}
                    </div>
                </div>
            </div>
            {{-- End header bar --}}

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <footer class="-mt-6">
            @include('layouts.footer')
        </footer>
        @livewireScripts
        @if ( Route::currentRouteName() == 'podcast.display' )
            <script src="{{ asset('/js/player.js') }}"></script>
        @endif
    </body>
</html>
