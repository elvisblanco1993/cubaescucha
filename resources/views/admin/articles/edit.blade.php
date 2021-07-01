<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-500">
                <a class="text-indigo-500" href="{{ route('articles') }}">{{ __('Articles') }}</a>
                <span class="mx-1">/</span>
                <span>{{ __('Edit Article') }}</span>
            </div>
            <a href="{{ url()->previous() }}" class="flex text-sm items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                {{__("Go back")}}
            </a>
        </div>
    </div>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="my-12">
            <form action="{{ route('article-update', ['article' => $article->id]) }}" method="post">
                @csrf

                <div class="my-8">
                    <input type="text" name="title" placeholder="Title" value="{{$article->title}}">
                    @error('title')
                        {{ $message }}
                    @enderror
                </div>

                <div class="my-8">
                    <textarea name="excerpt" cols="30" rows="2" placeholder="Excerpt">{{$article->excerpt ?? ''}}</textarea>
                </div>

                <div class="my-8">
                    <input type="text" name="tags" placeholder="Tags (separate tags with a comma)" value="{{$article->tags}}">
                    @error('tags')
                        {{ $message }}
                    @enderror
                </div>

                <div class="my-8">
                    <select name="lang">
                        <option></option>
                        <option value="en">{{ __("English") }}</option>
                        <option value="es">{{ __("Spanish") }}</option>
                    </select>
                </div>

                <div class="my-8">
                    <textarea name="body" id="body" cols="30" rows="20">{{$article->body}}</textarea>
                    @error('body')
                        {{ $message }}
                    @enderror
                </div>

                <x-jet-button type="submit">{{__("Save Article")}}</x-jet-button>
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
