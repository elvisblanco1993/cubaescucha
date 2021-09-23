<nav x-data="{ open: false }" class="bg-bluegray-900 border-b border-bluegray-800 @guest shadow @endguest">
    <!-- Primary Navigation Menu -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex-shrink-0 flex items-center">
                <a href="{{ config('app.url') }}">
                    <div class="h-9 w-auto py-1 flex items-center gap-3 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="isolation:isolate" viewBox="0 0 24 24" width="24pt" height="24pt"><defs><clipPath id="_clipPath_peRyZCFjFyaLczLfETpjL1GWRy33SUFv"><rect width="24" height="24"/></clipPath></defs><g clip-path="url(#_clipPath_peRyZCFjFyaLczLfETpjL1GWRy33SUFv)"><g><mask id="_mask_0aSnYAFNG0FEU45IK9Evr3pFwlFOmvD1"><circle vector-effect="non-scaling-stroke" cx="12" cy="12" r="11.5" fill="white" stroke="none"/></mask><circle vector-effect="non-scaling-stroke" cx="12" cy="12" r="11.5" fill="none"/><circle vector-effect="non-scaling-stroke" cx="12" cy="12" r="11.5" fill="none" mask="url(#_mask_0aSnYAFNG0FEU45IK9Evr3pFwlFOmvD1)" stroke-width="5" stroke="rgb(255,255,255)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><g><line x1="6" y1="8.5" x2="6" y2="15.5" vector-effect="non-scaling-stroke" stroke-width="2.3" stroke="rgb(255,255,255)" stroke-linejoin="miter" stroke-linecap="round" stroke-miterlimit="3"/><line x1="10" y1="6.715" x2="10" y2="17.285" vector-effect="non-scaling-stroke" stroke-width="2.3" stroke="rgb(255,255,255)" stroke-linejoin="miter" stroke-linecap="round" stroke-miterlimit="3"/><line x1="14" y1="5.215" x2="14" y2="18.785" vector-effect="non-scaling-stroke" stroke-width="2.5" stroke="rgb(255,255,255)" stroke-linejoin="miter" stroke-linecap="round" stroke-miterlimit="3"/><line x1="18" y1="9" x2="18" y2="15" vector-effect="non-scaling-stroke" stroke-width="2.4" stroke="rgb(255,255,255)" stroke-linejoin="miter" stroke-linecap="round" stroke-miterlimit="3"/></g></g></g></svg>
                        <div id="logotype">
                            voicebits.co
                        </div>
                    </div>
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


