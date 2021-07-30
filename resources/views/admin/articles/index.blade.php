<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center font-semibold text-lg text-gray-600 leading-tight">
                    {{__("Support Articles")}}
                </div>

                <div class="flex items-center gap-8 -my-2">
                    <x-jet-button onclick="window.location.href='{{ route('articles-create') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="hidden sm:flex sm:ml-2">
                            {{ __('Create Article') }}
                        </span>
                    </x-jet-button>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-5xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="my-12">
            @livewire('admin.articles.index')
        </div>
    </div>
</x-app-layout>
