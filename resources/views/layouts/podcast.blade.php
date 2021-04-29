<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $name }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            {{-- Header bar --}}
            <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
                <div class="text-right text-sm text-gray-400 hover:text-indigo-600">
                    <a href="{{ '' }}">
                        {{ __('Explore more podcasts') }}
                    </a>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        @livewireScripts
        <script src="{{ asset('/js/player.js') }}"></script>
    </body>
</html>
