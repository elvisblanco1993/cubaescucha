<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <form method="POST" wire:submit.prevent="storeEpisode">
        @csrf
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3">
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            {{ __('Title') }}
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" wire:model.defer="title" id="title">
                        </div>
                        @error('title')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="show_notes" class="block text-sm font-medium text-gray-700">
                        {{ __('Episode notes') }}
                    </label>
                    <div class="mt-1">
                        <textarea id="show_notes" wire:model.defer="show_notes" rows="8" ></textarea>
                    </div>
                    @error('show_notes')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">
                        {{ __('Markdown is supported.') }}
                    </p>

                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('Episode type') }}
                    </label>
                    <label class="inline-flex items-center mr-2 border border-gray-300 shadow-sm p-2 rounded">
                        <input type="radio" wire:model.defer="type" name="type" value="full" class="mr-2 rounded-full">
                        {{ __('Full episode') }}
                    </label>
                    <label class="inline-flex items-center mr-2 border border-gray-300 shadow-sm p-2 rounded">
                        <input type="radio" wire:model.defer="type" name="type" value="trailer" class="mr-2 rounded-full">
                        {{ __('Trailer') }}
                    </label>
                    <label class="inline-flex items-center mr-2 border border-gray-300 shadow-sm p-2 rounded">
                        <input type="radio" wire:model.defer="type" name="type" value="bonus" class="mr-2 rounded-full">
                        {{ __('Bonus') }}
                    </label>
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.defer="explicit" class="mr-2 rounded">
                        {{ __('This episode includes explicit content.') }}
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                    {{__('Episode audio file')}}
                    </label>
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mic" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z"/>
                                <path fill-rule="evenodd" d="M10 8V3a2 2 0 1 0-4 0v5a2 2 0 1 0 4 0zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3z"/>
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>{{__('Upload an audio file')}}</span>
                                    <input id="file-upload" wire:model.defer="audio_file" type="file" accept="audio/mpeg" class="sr-only">
                                </label>
                                <p class="pl-1">{{__('or drag and drop')}}</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                {{__('MP3 up to 240MB')}}
                            </p>
                        </div>
                    </div>

                    @if ($audio_file)
                        <audio id="audio_temp" src="{{ $audio_file->temporaryUrl() }}" preload="metadata"></audio>
                        <script>
                            var audioFile = document.getElementById("audio_temp");
                            audioFile.onloadedmetadata = function() {
                                window.livewire.emit('getAudioDuration', audioFile.duration);
                            }
                        </script>
                    @endif

                    @error('audio_file')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex">
                    <div class="w-1/2 pr-4">
                        <label class="block text-sm font-medium text-gray-700" for="season">
                            {{ __('Season number') }}
                        </label>
                        <input type="number" wire:model.defer="season">
                    </div>
                    <div class="w-1/2 pl-4">
                        <label class="block text-sm font-medium text-gray-700" for="episode_no">
                            {{ __('Episode number') }}
                        </label>
                        <input type="number" wire:model.defer="episode_no">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        {{ __('Publishing date') }}
                    </label>
                    <input type="date" wire:model.defer="published_at" value="{{ $published_at }}">
                    <small class="text-gray-500">
                        {{ __('If no date is selected, set to ') . date('m/d/Y', strtotime($published_at)) }}
                    </small>
                </div>

            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <x-jet-button>
                    <div wire:loading wire:target="storeEpisode">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    {{ __('Create episode') }}
                </x-jet-button>
            </div>
        </div>
    </form>
</div>
