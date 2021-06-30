<div>
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" wire:submit.prevent="save">
        @csrf
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                {{-- Episode Details --}}
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3">
                                <label for="title" class="block text-xs font-medium text-blueGray-500">
                                    {{ __('Title') }} <span class="text-red-600">*</span>
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
                            <label for="show_notes" class="block text-xs font-medium text-blueGray-500">
                                {{ __('Episode notes') }} <span class="text-red-600">*</span>
                            </label>
                            <div class="mt-1">
                                <textarea id="show_notes" wire:model.defer="show_notes" rows="8"></textarea>
                            </div>
                            @error('show_notes')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">
                                {{ __('Markdown is supported.') }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-blueGray-500 mb-1">
                                {{ __('Episode type') }} <span class="text-red-600">*</span>
                            </label>
                            <label class="inline-flex items-center text-sm mr-2 border border-gray-300 text-blueGray-600 shadow-sm p-2 rounded">
                                <input type="radio" wire:model.defer="type" name="type" value="full" class="mr-2 rounded-full">
                                {{ __('Full episode') }}
                            </label>
                            <label class="inline-flex items-center text-sm mr-2 border border-gray-300 text-blueGray-600 shadow-sm p-2 rounded">
                                <input type="radio" wire:model.defer="type" name="type" value="trailer" class="mr-2 rounded-full">
                                {{ __('Trailer') }}
                            </label>
                            <label class="inline-flex items-center text-sm mr-2 border border-gray-300 text-blueGray-600 shadow-sm p-2 rounded">
                                <input type="radio" wire:model.defer="type" name="type" value="bonus" class="mr-2 rounded-full">
                                {{ __('Bonus') }}
                            </label>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-blueGray-500">
                            {{ __('Episode audio file') }}
                            </label>
                            <div class="relative h-16 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                                <div class="absolute">
                                    <div class="flex items-center gap-2">
                                        @if ($audio_file)
                                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mic" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z"/>
                                                <path fill-rule="evenodd" d="M10 8V3a2 2 0 1 0-4 0v5a2 2 0 1 0 4 0zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3z"/>
                                            </svg>
                                            <span class="block font-normal text-sm text-green-500">{{ __("Audio file OK!") }}</span>
                                        @else
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mic" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z"/>
                                                <path fill-rule="evenodd" d="M10 8V3a2 2 0 1 0-4 0v5a2 2 0 1 0 4 0zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3z"/>
                                            </svg>
                                            <span class="block font-normal text-sm">{{ __("Upload and audio file") }}<p class="text-xs text-gray-500">{{__('MP3 up to 240MB')}}</p></span>
                                        @endif
                                    </div>
                                </div>
                                <input id="file-upload" wire:model.defer="audio_file" type="file" accept="audio/mpeg" class="h-full w-full opacity-0 cursor-pointer">
                            </div>
                            @error('audio_file')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div class="md:col-span-1">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6 shadow sm:rounded-md sm:overflow-hidden">
                    <label class="block text-xs font-medium text-blueGray-500 mb-1">{{ __("Preview episode") }}</label>

                    <audio controls class="w-full" controlsList="nodownload">
                        <source src="{{ Storage::disk('s3')->url($episode->file_name) }}" type="audio/mpeg">
                    </audio>

                    <div class="border-b"></div>

                    <x-jet-button>
                        <div wire:loading wire:target="save">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        {{ __('Save changes') }}
                    </x-jet-button>

                </div>

                <div class="my-6">
                    <a wire:click="$toggle('confirmDeleteEpisode')" class="text-sm text-red-500 cursor-pointer flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        {{ __("Delete Episode") }}
                    </a>
                </div>
                <x-jet-confirmation-modal wire:model="confirmDeleteEpisode">
                    <x-slot name="title">
                        {{ __('Are you sure you want to delete this episode?') }}
                    </x-slot>

                    <x-slot name="content">
                        {{ __('Once you delete this episode, its content will be lost forever, including any analytics-related data we may have collected in the past.') }}
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('confirmDeleteEpisode')">
                            {{ __('Nevermind') }}
                        </x-jet-secondary-button>
                        <x-jet-danger-button wire:click="delete">
                            {{ __('I understand. Delete Episode') }}
                        </x-jet-danger-button>
                    </x-slot>
                </x-jet-confirmation-modal>
            </div>
        </div>
    </form>

</div>
