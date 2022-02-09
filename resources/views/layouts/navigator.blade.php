<div @click.away="open = false" class="flex flex-col w-full md:w-64 text-slate-400 bg-slate-50 border-r flex-shrink-0" x-data="{ open: false }">
    <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
        <a href="{{ route('podcasts') }}">
            <x-jet-application-mark class="block h-9 w-auto text-black" />
        </a>
        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>

    <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto text-slate-600">

        <a href="{{ route('podcasts') }}"
            @class([
                'px-4 my-4 text-sm font-medium flex items-center transition hover:text-slate-900',
                'text-indigo-600' => request()->routeIs('podcasts')
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd" />
            </svg>
            {{ __("Podcasts") }}
        </a>
        @if (auth()->user()->isAdmin())
            <a href="{{ route('teams') }}"
                @class([
                    'px-4 my-4 text-sm font-medium flex items-center transition hover:text-slate-900',
                    'text-indigo-600' => request()->routeIs('teams')
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
                {{ __("Accounts") }}
            </a>
        @endif

        <div class="my-4 sm:mt-48 border-b"></div>

        <div class="text-xs uppercase text-slate-500 font-semibold px-4 mb-6">
            {{__("Manage")}}
        </div>

        <a href="{{ route('help') }}"
            @class([
                'px-4 my-4 text-sm font-medium flex items-center transition hover:text-slate-900',
                'text-indigo-600' => request()->routeIs('help')
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd" />
            </svg>
            {{ __("Help") }}
        </a>

        <a href="{{ route('billing-portal') }}"
            @class([
                'px-4 my-4 text-sm font-medium flex items-center transition hover:text-slate-900',
                'text-indigo-600' => request()->routeIs('billing-portal')
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
            </svg>
            {{ __("Billing") }}
        </a>
        <a href="{{ route('profile.show') }}"
            @class([
                'px-4 my-4 text-sm font-medium flex items-center transition hover:text-slate-900',
                'text-indigo-600' => request()->routeIs('profile.show')
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            {{ __("Profile") }}
        </a>

        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div x-data="{ open: false }">
                <button x-on:click="open = ! open"
                    @class([
                        'px-4 my-4 text-sm font-medium flex items-center transition hover:text-slate-900',
                    ])>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    <div class="flex items-center">
                        {{ Auth::user()->currentTeam->name }}
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>

                <div x-show="open" @click.away="open = false" x-transition x-cloak class="mt-1 px-4 py-2" style="display: none!important">
                    <a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        @class([
                            'px-4 my-4 text-sm font-medium flex items-center transition hover:text-slate-900',
                            'text-indigo-600' => request()->routeIs('teams.show')
                        ])>
                        {{ __('Team Settings') }}
                    </a>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <a href="{{ route('teams.create') }}"
                            @class([
                                'px-4 my-4 text-sm font-medium flex items-center transition hover:text-slate-900',
                                'text-indigo-600' => request()->routeIs('teams.create')
                            ])>
                            {{ __('Create New Team') }}
                        </a>
                    @endcan

                    <div class="border-t mb-2"></div>

                    @foreach (Auth::user()->allTeams() as $team)
                    <x-jet-switchable-team :team="$team" />
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
                @class([
                    'px-4 my-4 text-sm font-medium flex items-center transition hover:text-slate-900',
                    'text-indigo-600' => request()->routeIs('logout')
                ])
                onclick="event.preventDefault(); this.closest('form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                </svg>
                {{ __('Log Out') }}
            </a>
        </form>
    </nav>
</div>
