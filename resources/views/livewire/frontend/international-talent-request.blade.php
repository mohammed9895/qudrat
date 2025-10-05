<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-[160px] pb-28" wire:ignore>
        <div class="container ">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.international-talent-request.title') }}</h2>
                    {{ __('general.international-talent-request.description') }}
                </div>
                <div class="w-6/12">
                </div>
            </div>
        </div>
    </div>

    <div class="container py-24">
        <form wire:submit="submit">
            {{ $this->form }}
            <x-filament::button type="submit" class="mt-3 bg-primary-1" >
                {{ __('general.submit') }}
            </x-filament::button>
        </form>
    </div>
    <x-filament-actions::modals/>
</div>
