<div>
    <div class="text-4xl font-semibold">
        {{ __("What's the link to your podcast's RSS feed?") }}
    </div>
    <div class="mt-4">
        {{__("Only add a link to an RSS feed you own the rights to, and make sure you have access to the podcast's email.")}}
    </div>

    <div class="mt-8">
        <label for="url" class="text-xs font-semibold text-gray-500 mb-1">
            {{ __("Link to RSS feed") }}
        </label>
        <input id="url" type="text" wire:model="url" placeholder="https://" class="@error('url') border-red-400 @enderror">
        @error('url')
            <small class="block text-red-600">{{__($message)}}</small>
        @enderror
    </div>

    <div class="mt-24 flex items-center justify-end gap-8">
        <x-jet-button wire:click="verifyPodcast">
            {{_("Next")}}
        </x-jet-button>
    </div>
</div>
