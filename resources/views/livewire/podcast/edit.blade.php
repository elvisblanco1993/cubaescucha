<div>
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-6 py-4 mb-6 rounded-lg">
            {{ __(session('success')) }}
        </div>
    @endif
    <form method="POST" wire:submit.prevent="save">
        @csrf
        <div class="px-4 py-8 sm:px-6 lg:px-8 border sm:rounded-lg">
            <div class="mb-8">
                <div class="text-lg font-semibold">
                    {{ __("Podcast Details") }}
                </div>
                <p class="text-sm font-normal text-blueGray-600">{{__("Tell us a bit about your podcast.")}}</p>
            </div>

            <div class="grid grid-cols-4">
                <div class="col-span-4 md:col-span-1 mb-8">

                    {{-- Podcast Thumbnail --}}

                    @if ($thumbnail)
                        <img src="{{ $thumbnail->temporaryUrl() }}" alt="" class="rounded-lg mb-2 md:h-48 md:w-48 object-cover">
                    @else
                        <img src="{{ Storage::disk('s3')->url($podcast->thumbnail) }}" alt="" class="rounded-lg mb-2 md:h-48 md:w-48 object-cover">
                    @endif

                    <div class="relative py-1 md:w-48 rounded-lg border border-gray-200 flex justify-center items-center">
                        <div class="absolute">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="block font-normal text-sm">{{ __("Replace Image") }}</span>
                            </div>
                        </div>
                        <input id="file-upload" wire:model.defer="thumbnail" type="file" accept="image/png,image/webp,image/jpeg" class="h-full w-full opacity-0 cursor-pointer" name="">
                    </div>
                    @error('thumbnail')
                            <small class="text-red-600">{{ $message }}</small>
                    @enderror

                </div>

                <div class="col-span-4 md:col-span-3 space-y-4">

                    {{-- Podcast Details --}}
                    <div>
                        <label for="name" class="block text-xs font-medium text-blueGray-500">
                            {{ __('Name') }} <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" wire:model.defer="name" id="name">
                        </div>
                        @error('name')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-medium text-blueGray-500">
                            {{ __('Description') }} <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-1">
                            <textarea id="description" wire:model.defer="description" rows="8"></textarea>
                        </div>
                        @error('description')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="tags" class="block text-xs font-medium text-blueGray-500">
                            {{ __('Tags') }} <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" wire:model.defer="tags" id="tags" placeholder="entertainment, sports, music...">
                        </div>
                        @error('tags')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-blueGray-500 mb-1">
                            {{ __('Podcast style') }} <span class="text-red-600">*</span>
                        </label>
                        <select wire:model.defer="style">
                            <option></option>
                            <option value="e" title="{{__("For news and current affairs types of shows.")}}">{{__("Episodic")}}</option>
                            <option value="ews" title="{{__("For news and current affairs types of shows, but with multiple seasons.")}}">{{__("Episodic with Seasons")}}</option>
                            <option value="s" title="{{__("Your listeners are best to consume your podcast in a specific order of episodes, where you may have one or more series and each series has a specific order for the episodes.")}}">{{__("Serial")}}</option>
                        </select>
                    </div>

                    <div>
                        <label for="lang" class="block text-xs font-medium text-blueGray-500">
                            {{ __('Language') }} <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <select wire:model.defer="lang" data-placeholder="Choose a Language...">
                                <option></option>
                                <option value="EN">{{ __("English") }}</option>
                                <option value="FR">{{ __("French") }}</option>
                                <option value="PT">{{ __("Portuguese") }}</option>
                                <option value="ES">{{ __("Spanish") }}</option>
                            </select>
                        </div>
                        @error('lang')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="website_style" class="block text-xs font-medium text-blueGray-500">
                            {{ __('Website style') }} <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <select wire:model.defer="website_style" data-placeholder="Choose a website style...">
                                <option></option>
                                <option value="modern">{{ __("Modern") }}</option>
                                <option value="classic">{{ __("Classic") }}</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Content Rating --}}
        <div class="px-4 py-8 sm:px-6 lg:px-8 border sm:rounded-lg my-6">
            <div class="text-lg font-semibold mb-2">{{__("Content Rating")}}</div>

            <label class="inline-flex items-center text-sm font-medium text-blueGray-800">
                <input type="checkbox" wire:model.defer="explicit" class="mr-2 rounded">
                {{ __('This podcast includes explicit content.') }}
            </label>
            @error('explicit')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="px-4 py-8 sm:px-6 lg:px-8 border sm:rounded-lg my-6">
            <div class="text-lg font-semibold mb-2">{{__("Directories")}}</div>
            <p class="text-smtext-sm text-gray-600 mb-4">{{ __("Use this area to share the links of the directories to which you published your show to.") }}</p>

            <div>
                <label for="spotify" class="block text-xs font-medium text-blueGray-500 mb-1">Spotify</label>
                <input id="spotify" type="text" wire:model.defer="spotifypodcasts_url">
            </div>
            <div class="my-4">
                <label for="apodcasts" class="block text-xs font-medium text-blueGray-500 mb-1">Apple Podcasts</label>
                <input id="apodcasts" type="text" wire:model.defer="applepodcasts_url">
            </div>
            <div class="my-4">
                <label for="gpodcasts" class="block text-xs font-medium text-blueGray-500 mb-1">Google Podcasts</label>
                <input id="gpodcasts" type="text" wire:model.defer="googlepodcasts_url">
            </div>
        </div>

        <div class="px-4 sm:px-0 my-6 flex items-center justify-end gap-8">
            <label class="inline-flex items-center text-sm font-medium text-blueGray-500" title="{{ __('By checking this option you are making this podcast publicly visible.') }}">
                <input type="checkbox" wire:model.defer="public" class="mr-2 rounded">
                {{ __('Make public') }}
            </label>

            <x-jet-button>
                <div wire:loading wire:target="save">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                {{ __('Save Changes') }}
            </x-jet-button>
        </div>
    </form>

    <div class="px-4 py-8 sm:px-6 lg:px-8 border border-red-200 sm:rounded-lg my-6 bg-red-50">
        <div class="text-lg font-semibold mb-2 text-red-600">{{__("Danger Zone")}}</div>

        <p class="text-sm text-gray-600 mb-4">
            {{ __("Once this podcast is deleted, all of its resources and data will be permanently deleted. Before deleting this podcast, please download any data or information that you wish to retain.") }}
        </p>

        <a wire:click="$toggle('confirmDeleteDialog')" class="text-sm text-red-500 cursor-pointer flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            {{ __("Delete Podcast") }}
        </a>
        {{-- Delete Podcast Dialog --}}
        <x-jet-confirmation-modal wire:model.defer="confirmDeleteDialog">
            <x-slot name="title">
                {{ __('Are you sure you want to delete this podcast?') }}
            </x-slot>

            <x-slot name="content">
                <p class="text-base">
                    {{ __('Please notice that once you delete this podcast, all its contents will be lost forever. We strongly recommend you make a backup of your data before deleting the podcast.') }}
                </p>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmDeleteDialog')" class="mx-2">
                    {{  __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="deletePodcast" class="mx-2">
                    <div wire:loading wire:target="deletePodcast">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    {{ __('I understand. Delete Podcast') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </div>
</div>
