<div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-4 align-middle inline-block min-w-full sm:px-6 lg:px-8">

                {{-- Search Users --}}
                <div class="mb-6">
                    <input  type="search"
                            placeholder="{{__("Search")}}"
                            wire:model="query"
                            accesskey="/"
                            wire:keydown.escape="cancel"
                            wire:keyup="search"
                            class="w-1/2 sm:w-1/4">
                </div>

                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__("Name")}}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__("Podcasts")}}
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">{{__("Edit")}}</span>
                        </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($teams as $team)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $team->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $team->email }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $team->podcasts->count() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">{{__("Edit")}}</a>
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
</div>
