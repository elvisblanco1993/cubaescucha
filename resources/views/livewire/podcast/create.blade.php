<div>
    <form method="POST" wire:submit.prevent="storePodcast">
        @csrf
        <div class="px-4 py-8 sm:px-6 lg:px-8 border sm:rounded-lg">
            <div class="mb-8">
                <div class="text-lg font-semibold">
                    {{ __("Podcast Details") }}
                </div>
                <p class="text-sm font-normal text-blueGray-600">{{__("Tell us a bit about your podcast.")}}</p>
            </div>

            <div class="grid grid-cols-4 gap-8">
                <div class="col-span-4 md:col-span-1 mb-8">

                    {{-- Podcast Thumbnail --}}

                    @if ($thumbnail)
                        <img src="{{ $thumbnail->temporaryUrl() }}" alt="" class="rounded-lg mb-2 md:h-48 md:w-full object-cover">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" alt="" class="rounded-lg mb-2 md:h-48 md:w-full object-cover">
                    @endif

                    <div class="relative py-1 w-36 rounded-lg border border-gray-200 flex justify-center items-center mx-auto">
                        <div class="absolute">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blueGray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="block font-normal text-xs">{{ __("Upload Image") }}</span>
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
                            <input type="text" wire:model="name" id="name">
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
                            <input type="text" wire:model="tags" id="tags" placeholder="entertainment, sports, music...">
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
                        @error('style')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="lang" class="block text-xs font-medium text-blueGray-500">
                            {{ __('Language') }} <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <select wire:model="lang" data-placeholder="Choose a Language...">
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
                            <select wire:model="website_style" data-placeholder="Choose a website style...">
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
                <input type="checkbox" wire:model="explicit" class="mr-2 rounded">
                {{ __('This podcast includes explicit content.') }}
            </label>
            @error('explicit')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="px-4 sm:px-0 my-6 flex items-center justify-end gap-8">
            <label class="inline-flex items-center text-sm font-medium text-blueGray-500" title="{{ __('By checking this option you are making this podcast publicly visible.') }}">
                <input type="checkbox" wire:model="public" class="mr-2 rounded">
                {{ __('Make public') }}
            </label>

            <x-jet-button>
                <div wire:loading wire:target="storePodcast">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                {{ __('Create Podcast') }}
            </x-jet-button>
        </div>
    </form>
</div>
