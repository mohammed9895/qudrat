<x-filament-panels::page>
    <form wire:submit="create">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-3">
            Create
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
