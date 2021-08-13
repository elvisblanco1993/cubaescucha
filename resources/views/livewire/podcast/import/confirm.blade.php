<div>
    <div class="text-4xl font-semibold">
        {{ __("Let's confirm the ownership of this feed") }}
    </div>
    <div class="mt-4">
        {{__("We emailed you a code to the email associated with this feed's owner. Please enter the code below.")}}
    </div>

    <div class="mt-8">
        <label for="validation_code" class="text-xs font-semibold text-gray-500 mb-1">
            {{ __("Enter verification code") }}
        </label>
        <input id="validation_code" type="text" wire:model="validation_code" class="@error('validation_code') border-red-400 @enderror">
        @error('validation_code')
            <small class="block text-red-600">{{__($message)}}</small>
        @enderror
    </div>

    <div class="mt-24 flex items-center justify-end gap-8">
        <a href="{{ route('podcasts') }}" class="text-sm text-gray-500">{{ __("Cancel") }}</a>

        <x-jet-button wire:click="import">
            Finish and start importing
        </x-jet-button>
    </div>
</div>
