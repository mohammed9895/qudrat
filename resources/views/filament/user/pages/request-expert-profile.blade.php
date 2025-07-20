<x-filament-panels::page>
    <p>{{ __('general.request-expert-profile.description') }}</p>

    <form wire:submit="submit">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-3">
            {{ __('general.submit') }}
        </x-filament::button>
    </form>

    <div class="mt-10">
        {{ $this->table }}
    </div>

    <x-filament-actions::modals/>
</x-filament-panels::page>
