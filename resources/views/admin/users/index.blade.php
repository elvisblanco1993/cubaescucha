<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center font-semibold text-lg text-gray-600 leading-tight">
                {{__("Teams")}}
            </div>
        </div>
    </header>

    <div class="max-w-5xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="my-12">
            @livewire('admin.graphs')
            @livewire('admin.users.index')
        </div>
    </div>
</x-app-layout>
