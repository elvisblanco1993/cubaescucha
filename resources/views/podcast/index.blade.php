<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-500">
                <a class="text-indigo-500" href="{{ route('podcasts') }}">{{ __('Podcasts') }}</a>
            </div>

            <a href="{{ route('podcasts.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 -my-2">
                New Podcast
            </a>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="">

                <div class="grid grid-cols-2 gap-8">

                    @forelse ($podcasts as $podcast)

                        <a href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}" class="@if($loop->first && $loop->last) col-span-2 @else col-span-2 sm:col-span-1 @endif bg-white shadow sm:rounded-lg hover:shadow-xl hover:text-indigo-600">
                            <div>
                                <img src="{{ Storage::disk('s3')->url($podcast->thumbnail) }}" alt="{{ $podcast->name }}" class="object-cover w-full h-64 rounded-t-lg">
                            </div>
                            <div class="p-6 bg-white rounded-b-lg">
                               <div class="text-lg font-bold">
                                    {{ $podcast->name }}
                               </div>
                            </div>
                        </a>

                    @empty

                    @endforelse

                </div>
















                {{-- Display list of podcasts --}}
                {{-- <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          {{ __('Podcast Name') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          {{ __('Public URL') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          {{ __('RSS Feed') }}
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">{{ __('Details') }}</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($podcasts as $podcast)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $podcast->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ config('app.url') . '/podcast/' . $podcast->slug }}" target="_blank" class="text-indigo-600 hover:text-indigo-400">
                                        {{ config('app.url') . '/podcast/' . $podcast->slug }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ asset('rss/'.$podcast->rss) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('podcasts.show', ['podcast' => $podcast->id]) }}" class="text-indigo-600 hover:text-indigo-900">View details</a>
                                </td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table> --}}
            </div>
            <div class="mt-6">
                {{ $podcasts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
