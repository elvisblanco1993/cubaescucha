<x-app-layout>
    <header class="border-b border-slate-100 bg-white">
        <div class=" px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center font-semibold text-lg text-slate-900 leading-tight">
                    {{__("Podcasts")}}
                </div>

                <div class="flex items-center gap-8 -my-2">
                    <x-jet-secondary-button onclick="window.location.href='{{ route('podcasts.import') }}'" title="Import podcast.">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                        <span class="hidden sm:flex sm:ml-2">
                            {{ __("Import Podcast") }}
                        </span>
                    </x-jet-secondary-button>
                    <x-jet-button onclick="window.location.href='{{ route('podcasts.create') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="hidden sm:flex sm:ml-2">
                            {{ __('Create Podcast') }}
                        </span>
                    </x-jet-button>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-5xl mx-auto my-12 px-4 sm:px-6 lg:px-8">

        @if ($podcasts->count() == 0)
            <div class="grid grid-cols-2 gap-10 items-center sm:mt-48">
                <div class="col-span-2 sm:col-span-1">
                    <div class="text-md space-y-4">
                        <p>{{ __("Hey there! Thanks a ton for signing up for Voicebits - We get really excited when someone new signs up!") }} 😊</p>
                        <p>{{ __("If you need help getting started, you can check out our Help section in the user menu, or simply hit the chat bubble on the bottom right and send us a message.") }}</p>
                        <p>{{ __("Thank you!") }} 🙏</p>
                        <div class="text-sm">
                            <p>Elvis,</p>
                            <p>{{ __("Founder of Voicebits") }}</p>
                        </div>
                        @if ( !auth()->user()->subscribed('default') && auth()->user()->onTrial() )
                            <div class="inline-block text-sm mt-4 px-2 py-1 bg-red-50 rounded-lg text-red-600">
                                {{ __("Trial ends: ") . date('F d, Y', strtotime(auth()->user()->trialEndsAt()))}}
                            </div>
                        @endif
                        @if (auth()->user()->subscribed('default')->onGracePeriod())
                            <div class="inline-block text-sm mt-4 px-2 py-1 bg-red-50 rounded-lg text-red-600">
                                {{ __("You subscription is valid until: ") . date('F d, Y', strtotime(auth()->user()->subscription->ends_at))}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-span-2 sm:col-span-1 flex justify-end">
                    <img src="{{ asset('images/presenters.svg') }}" alt="Presenters" class="w-full">
                </div>
            </div>
        @else
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__("Podcast")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__("Status")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__("Followers")}}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">{{__("Edit")}}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- More people... -->
                                @forelse ($podcasts as $podcast)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('covers/'.$podcast->thumbnail) }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $podcast->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($podcast->is_public == 'on')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{__("Active")}}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{__("Inactive")}}
                                            </span>
                                        @endif
                                      </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $podcast->followers->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}" class="text-indigo-600 hover:text-indigo-900">Details</a>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

</x-app-layout>
