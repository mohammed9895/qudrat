<x-filament-panels::page>
    <form wire:submit="generate">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-3">
            Generate CV
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
