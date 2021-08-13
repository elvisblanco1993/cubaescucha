<div>
    <div class="text-4xl font-semibold">
        {{ __("Enter a podcast RSS feed") }}
    </div>
    <div class="mt-4">
        {{__("To get insights about a podcast, you must have access to the email associated with it.")}}
    </div>

    <div class="mt-8">
        <label for="url" class="text-xs font-semibold text-gray-500 mb-1">
            {{ __("Enter RSS feed URL") }}
        </label>
        <input id="url" type="text" wire:model="url" placeholder="https://" class="@error('url') border-red-400 @enderror">
        @error('url')
            <small class="block text-red-600">{{__($message)}}</small>
        @enderror
    </div>

    <div class="mt-24 flex items-center justify-end gap-8">
        <a href="{{ route('podcasts') }}" class="text-sm text-gray-500">{{ __("Cancel") }}</a>

        <x-jet-button wire:click="verifyPodcast">
            Next step
        </x-jet-button>
    </div>
</div>
