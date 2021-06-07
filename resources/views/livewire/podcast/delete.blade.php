<x-jet-action-section>
    <x-slot name="title">
        {{ __('Delete Podcast') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this podcast.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Please notice that once you delete this podcast, all its contents will be lost forever. We strongly recommend you make a backup of your data before deleting the podcast.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="$toggle('confirmDeleteDialog')" wire:loading.attr="disabled">
                {{ __('Delete Podcast') }}
            </x-jet-danger-button>
        </div>

        <x-jet-confirmation-modal wire:model="confirmDeleteDialog">
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

    </x-slot>
</x-jet-action-section>

