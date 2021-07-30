<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-6">
                <div class="flex items-center font-semibold text-lg text-gray-600 leading-tight">
                    <a class="text-indigo-500" href="{{ route('articles') }}">{{ __('Articles') }}</a>
                    <span class="mx-1">/</span>
                    <span>{{ __('New Article') }}</span>
                </div>

                <a href="{{ url()->previous() }}" class="flex text-sm items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    {{__("Go back")}}
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-5xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="my-12 bg-white p-4 sm:px-6 lg:px-8 rounded-lg shadow">
            <form action="{{ route('article-store') }}" method="post">
                @csrf

                <div class="my-8">
                    <label class="mb-1 block text-xs font-medium text-blueGray-500">
                        {{ __('Title') }} <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="title" placeholder="{{__("Title")}}">
                    @error('title')
                        <small class="text-red-600 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <div class="my-8">
                    <label class="mb-1 block text-xs font-medium text-blueGray-500">
                        {{ __('Excerpt') }}
                    </label>
                    <textarea name="excerpt" cols="30" rows="2" placeholder="{{__("Excerpt")}}"></textarea>
                </div>

                <div class="my-8">
                    <label class="mb-1 block text-xs font-medium text-blueGray-500">
                        {{ __('Tags') }} <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="tags" placeholder="">
                    @error('tags')
                        <small class="text-red-600 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <div class="my-8">
                    <label class="mb-1 block text-xs font-medium text-blueGray-500">
                        {{ __('Language') }} <span class="text-red-600">*</span>
                    </label>
                    <select name="lang">
                        <option></option>
                        <option value="en">{{ __("English") }}</option>
                        <option value="es">{{ __("Spanish") }}</option>
                    </select>
                </div>

                <div class="my-8">
                    <label class="mb-1 block text-xs font-medium text-blueGray-500">
                        {{ __('Article') }} <span class="text-red-600">*</span>
                    </label>
                    <textarea name="body" id="body" cols="30" rows="20"></textarea>
                    @error('body')
                        <small class="text-red-600 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <x-jet-button type="submit">{{__("Save Article")}}</x-jet-button>
                </div>
            </form>

            <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
            <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
            <script>
                var easyMDE = new EasyMDE({element: document.getElementById('body')});
                var easyMDESpanish = new EasyMDE({element: document.getElementById('body_es')});
            </script>
        </div>
    </div>
</x-app-layout>
