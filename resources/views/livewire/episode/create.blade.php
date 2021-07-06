<div>
    {{--  --}}
    <form method="POST" wire:submit.prevent="storeEpisode">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        @csrf
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
                                    <label class="inline-flex items-center text-sm font-medium text-blueGray-500">
                                        <input type="checkbox" wire:model.defer="explicit" class="mr-2 rounded">
                                        {{ __('This episode includes explicit content.') }}
                                    </label>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-blueGray-500">
                                    {{__('Episode audio file')}} <span class="text-red-600">*</span>
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

                                <div class="flex gap-8">
                                    @if ($podcast->style == 'ews')
                                    <div class="w-full sm:w-1/2">
                                        <label class="block text-xs font-medium text-blueGray-500" for="season">
                                            {{ __('Season number') }} <span class="text-red-600">*</span>
                                        </label>
                                        <input type="number" wire:model.defer="season">
                                    </div>
                                    @endif
                                    <div class="w-full sm:w-1/2">
                                        <label class="block text-xs font-medium text-blueGray-500" for="episode_no">
                                            {{ __('Episode number') }} <span class="text-red-600">*</span>
                                        </label>
                                        <input type="number" wire:model.defer="episode_no">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-1">

                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6 shadow sm:rounded-md sm:overflow-hidden">

                            <div class="w-full flex items-center justify-between">
                                <a wire:click="enablePublishOption" class="cursor-pointer hover:text-indigo-500 text-sm">{{ __("Publish later") }}</a>

                                <x-jet-button>
                                    <div wire:loading wire:target="storeEpisode">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                    {{ __('Save') }} & @if ($publish == false){{ __("Publish") }}@else{{ __("Schedule") }}@endif
                                </x-jet-button>
                            </div>

                            @if ($publish == true)
                            <div class="grid grid-cols-4 gap-1 text-xs">
                                <div class="col-span-2 flex items-center gap-1">
                                    <input type="date" wire:model="publish_date">
                                    <span>@</span>
                                </div>
                                <input type="number" min="0" max="23" wire:model="publish_hour" placeholder="HH">
                                <input type="number" min="0" max="59" wire:model="publish_minute" placeholder="MM">
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
