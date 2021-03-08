<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <button class="mx-2 text-red-600 hover:text-red-800" wire:click="$toggle('confirmDeleteDialog')">
        <svg class="w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
        </svg>
    </button>

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
            <x-jet-secondary-button wire:click="$toggle('confirmDeleteDialog')">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="deletePodcast">
                <div wire:loading>
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
