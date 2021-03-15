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
            @livewire('navigation-menu')

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
