<x-filament-panels::page>
    <form wire:submit="create">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-3">
            {{ __('general.save') }}
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
