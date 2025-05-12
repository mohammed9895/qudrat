<x-filament-panels::page>
    <form wire:submit="generate">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-3">
            {{ __('general.cvmaker.generate_cv_button') }}
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
