<nav x-data="{ open: false }" class="bg-bluegray-900 border-b border-bluegray-800 @guest shadow @endguest">
    <!-- Primary Navigation Menu -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex-shrink-0 flex items-center">
                <a href="{{ config('app.url') }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex items-center uppercase text-sm">

                @auth
                <a href="{{ route('podcasts') }}" class="text-white text-xs font-semibold px-8 py-3 border border-bluegray-600 rounded-lg hover:bg-bluegray-800 hover:border-bluegray-500 transition">
                    {{ __('Back to Dashboard') }}
                </a>
                @endauth

                @guest
                <a href="{{ route('login') }}" class="text-white font-semibold text-xs mx-4">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}" class="text-white text-xs font-semibold px-8 py-3 border border-bluegray-600 rounded-lg hover:bg-bluegray-800 hover:border-bluegray-500 transition">
                    {{ __('Sign up') }}
                </a>
                @endguest

            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-bluegray-600 hover:text-bluegray-600 hover:bg-bluegray-100 focus:outline-none focus:bg-bluegray-100 focus:text-gray-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @guest
                <x-jet-responsive-nav-link href="{{ route('login') }}" class="mt-2">
                    {{ __('Login') }}
                </x-jet-responsive-nav-link>

                <x-jet-responsive-nav-link href="{{ route('register') }}">
                    {{ __('Get Started') }}
                </x-jet-responsive-nav-link>
            @endguest
        </div>
    </div>
</nav>


