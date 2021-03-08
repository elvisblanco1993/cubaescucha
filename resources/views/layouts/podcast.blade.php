<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $name }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased" style="font-family: 'Poppins', sans-serif;">
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
