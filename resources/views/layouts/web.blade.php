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
        <div class="min-h-screen">

            {{-- Header bar --}}
            <div class="headerbar shadow-sm mb-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center w-full sm:w-2/6 md:w-1/6">
                            <a href="{{ route('home') }}">
                                <x-jet-application-mark class="block h-9 w-full" />
                            </a>
                        </div>

                        <div class="hidden sm:block sm:w-3/6">
                            @livewire('podcast-search')
                        </div>

                        {{-- Navigation Links --}}
                        <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex uppercase text-sm">
                            @guest
                                <a href="{{ route('login') }}" :active="request()->routeIs('login')">
                                    {{ __('Login') }}
                                </a>

                                <a href="{{ route('register') }}" :active="request()->routeIs('register')">
                                    {{ __('Get Started') }}
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
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
