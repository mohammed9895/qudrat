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

                <button type="submit"
                        style="background: #1d71b8 !important;"
                        class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg  fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm  text-white mt-3">
                    {{ __('general.send') }}
                </button>
            </form>

            <x-filament-actions::modals/>
        </div>
    </div>
    <!-- /Card & Siderbar -->
    @filamentScripts
</div>
