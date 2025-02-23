<div>
    @filamentStyles
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-24 md:pt-10 pb-5">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.feedback.main-title') }}</h2>
                </div>
                <div class="w-6/12">
                    <div class="text-end">
                        <img src="assets/images/banner_1.png" alt="images" class="hidden md:block">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Card & Siderbar -->
    <div class="pt-24 pb-12">
        <div class="container">
            <form wire:submit="create">
                {{ $this->form }}

                <button type="submit">
                    Submit
                </button>
            </form>

            <x-filament-actions::modals/>
        </div>
    </div>
    <!-- /Card & Siderbar -->
    @filamentScripts
</div>
