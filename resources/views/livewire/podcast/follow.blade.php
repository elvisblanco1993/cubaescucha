<div>
    {{-- Be like water. --}}
    @if($following)
    <x-jet-secondary-button wire:click="follow" class="uppercase text-xs">
         {{ __("Following") }}
    </x-jet-secondary-button>
    @else
    <x-jet-danger-button wire:click="follow" class="uppercase text-xs">
        {{ __("Follow") }}
    </x-jet-danger-button>
    @endif
</div>
