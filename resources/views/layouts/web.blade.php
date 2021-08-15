<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('storage/voicebits.ico') }}" type="image/x-icon">

        {{-- Opengraph --}}
        @if (request()->routeIs('podcast.display'))
        <meta property="og:url"         content="{{ Request::url() }}" />
        <meta property="og:type"        content="podcast" />
        <meta property="og:title"       content="{{ $name }}" />
        <meta property="og:description" content="{{ $description }}" />
        <meta property="og:image"       content="{{ $thumbnail }}" />
        @endif

        <title>@if( request()->routeIs('podcast.display') ) {{ $name . ' - ' }}  @endif {{ config('app.name', 'voicebits.co') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-bluegray-50">
        <div class="min-h-screen -mb-16">
            @livewire('navigation-menu')
            <main>
                @yield('content')
            </main>
        </div>
        <footer>
            @include('layouts.footer')
        </footer>
        @livewireScripts

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/60caa0f87f4b000ac0380686/1f8bo9ies';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    </body>
</html>
