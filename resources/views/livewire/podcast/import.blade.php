<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <x-jet-secondary-button wire:click="$toggle('importDialog')" title="Import podcast.">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
        </svg>
        <span class="hidden sm:flex sm:ml-2">
            {{ __("Import Podcast") }}
        </span>
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="importDialog">
        <x-slot name="title">
            {{__("Import Podcast")}}
        </x-slot>
        <x-slot name="content">
            {{__("Paste your old RSS feed url in the input field below, then click 'Import' to start importing your podcast.")}}
            <input type="text" wire:model="url" placeholder="https://" class="my-2 @error('url') border-red-400 @enderror">
            @error('url')
                <small class="block text-red-600">{{__($message)}}</small>
            @enderror

            <label class="text-xs text-blueGray-600">{{__("I certify that the content being imported is mine, or that I have been authorized to distribute it by its original owner and can provide proof of it if requested.")}}</label>
            <input type="text" wire:model="agree" placeholder="I AGREE">
            @error('agree')
                <small class="block text-red-600">{{__("You must agree before continuing")}}</small>
            @enderror

            <div class="mt-4 py-4 px-3 border border-red-400 text-red-600 bg-red-50 rounded text-sm">
                {{ __("NOTICE: This feature is currently unstable.") }}
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('importDialog')" class="mr-4">
                {{ __("Nevermind") }}
            </x-jet-secondary-button>
            <x-jet-button wire:click="import" wire:loading.attr="disabled" wire:ignore>
                {{ __("Import") }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
