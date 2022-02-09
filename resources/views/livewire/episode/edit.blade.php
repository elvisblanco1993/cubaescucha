<div>
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" wire:submit.prevent="save">
        @csrf
        <div class="px-4 py-8 sm:px-6 lg:px-8 border sm:rounded-lg">
            <div class="mb-8">
                <div class="text-lg font-semibold">
                    {{ __("Episode Details") }}
                </div>
                <p class="text-sm font-normal text-slate-600">{{__("Tell us a bit about This episode.")}}</p>
            </div>

            <div class="grid grid-cols-4 gap-8">
                <div class="col-span-4 md:col-span-1 mb-8">
                    <img src="{{ asset('covers/'.$podcast->thumbnail) }}" alt="" class="rounded-lg mb-2 md:h-48 md:w-48 object-cover">
                </div>

                <div class="col-span-4 md:col-span-3 space-y-4">
                    <div>
                        <label for="title" class="block text-xs font-medium text-slate-500">
                            {{ __('Title') }} <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" wire:model.defer="title" id="title">
                        </div>
                        @error('title')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="show_notes" class="block text-xs font-medium text-slate-500">
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
                        <label class="block text-xs font-medium text-slate-500 mb-1">
                            {{ __('Episode type') }} <span class="text-red-600">*</span>
                        </label>
                        <select wire:model.defer="type" id="">
                            <option></option>
                            <option value="full">{{ __('Full episode') }}</option>
                            <option value="trailer">{{ __('Trailer') }}</option>
                            <option value="bonus">{{ __('Bonus') }}</option>
                        </select>
                        @error('type')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="border-b"></div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">
                        {{__('Episode audio file')}} <span class="text-red-600">*</span>
                        </label>

                        <div class="relative h-16 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                            <div class="absolute">
                                <div class="flex items-center gap-2">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mic" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M10 8V3a2 2 0 1 0-4 0v5a2 2 0 1 0 4 0zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3z"/>
                                    </svg>
                                    <span class="block font-normal text-sm">{{ __("Update audio file") }}<p class="text-xs text-gray-500">{{__('MP3 up to ') . ini_get('upload_max_filesize')}}</p></span>
                                </div>
                            </div>
                            <input id="file-upload" wire:model.defer="audio_file" type="file" accept="audio/mpeg" class="h-full w-full opacity-0 cursor-pointer">
                        </div>
                        <div wire:loading wire:target="audio_file" class="text-sm">Uploading...</div>
                        @if ($audio_file)
                            <small class="text-green-600">Audio file ready.</small>
                        @endif
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
                </div>
            </div>
        </div>

        <div class="px-4 sm:px-0 my-6 flex items-center justify-end gap-8">
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
    </form>

    <div class="px-4 py-8 sm:px-6 lg:px-8 border sm:rounded-lg my-6 max-w-full">
        <div class="flex items-center justify-between mb-2">
            <div>
                <div class="text-lg font-semibold">{{ __('Embedded player') }}</div>
                <div class="text-sm font-normal text-slate-600">
                    {{__("Copy this code snippet into your website so so that visitors can listen to this episode from your site.")}}
                </div>
            </div>
            <div class="flex items-center">
                <span id="copiedMessage" class="text-xs text-green-600 mr-2"></span>
                <button id="btn" onclick="copyToClickBoard()" title="{{ __("Copy to clipboard") }}"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-500 hover:text-slate-700 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg></button>
            </div>
        </div>
        {{-- <pre class="overflow-auto bg-gray-800"><code id="code" class="text-xs text-green-400 px-2">{{ '<div id="voicebits-player-container" episode-title="'.$title.'" episode-owner="'.$podcast->team->name.'" podcast-url="'.route("podcast.display", ["podcast"=>$podcast->url]).'"><audio id="voicebits-player" type="audio/mpeg" src="'.Storage::disk("s3")->url($episode->file_name).'"></audio> <img id="voicebits-player-img" src="'.Storage::disk('local')->url($podcast->thumbnail).'" alt="'.$title.'"> </div> <script src="'.asset('js/embedded-player.js').'"></script>' }}</code></pre> --}}
        <script>
            if (!navigator.clipboard) {
                // Clipboard API not available
                console.log('No CLipboard API available');
            }
            function copyToClickBoard(){
                var content = document.getElementById('code').textContent;
                navigator.clipboard.writeText(content)
                    .then(() => {
                        document.getElementById('copiedMessage').innerText = "{{__('Code copied to clipboard.')}}";
                    })
                    .catch(err => {
                    console.log('Something went wrong', err);
                })
            }
        </script>
    </div>

    <div class="px-4 py-8 sm:px-6 lg:px-8 border border-red-200 sm:rounded-lg my-6 bg-red-50">
        <div class="text-lg font-semibold mb-2 text-red-600">{{__("Danger Zone")}}</div>

        <p class="text-sm text-gray-600 mb-4">
            {{ __("Once you delete this episode, its content will be lost forever, including any analytics-related data we may have collected in the past.") }}
        </p>

        <a wire:click="$toggle('confirmDeleteEpisode')" class="text-sm text-red-500 cursor-pointer flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            {{ __("Delete Episode") }}
        </a>
        {{-- Delete Podcast Dialog --}}
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
