<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-500">
                <a class="text-indigo-500" href="{{ route('articles') }}">{{ __('Articles') }}</a>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="my-12">
            @livewire('admin.articles.index')
        </div>
    </div>
</x-app-layout>
