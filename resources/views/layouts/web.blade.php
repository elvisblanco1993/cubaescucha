<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Opengraph --}}
        @if (request()->routeIs('podcast.display'))
        <meta property="og:url"         content="{{ Request::url() }}" />
        <meta property="og:type"        content="podcast" />
        <meta property="og:title"       content="{{ $name }}" />
        <meta property="og:description" content="{{ $description }}" />
        <meta property="og:image"       content="{{ $thumbnail }}" />
        @endif



        <title>@if( request()->routeIs('podcast.display') ) {{ $name . ' - ' }}  @endif {{ config('app.name', 'Cubaescucha.com') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-white">
        <div class="min-h-screen">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <footer>
            @include('layouts.footer')
        </footer>
        @livewireScripts
    </body>
</html>
