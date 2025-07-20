<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-24 md:pt-10 pb-5">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <div class="flex items-center gap-3 mb-3">
                        <a href="/" class="text-head-color text-sm">{{ __('general.home') }}</a>
                        <span class="text-gray-3 text-sm">/</span>
                        <span class="text-b-color text-sm">{{ __('general.social-window.page-title') }}</span>
                    </div>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.social-window.page-title') }}</h2>
                    <h2 class="mt-5 text-xl">{{ __('general.social-window.sub-title') }}</h2>
                </div>
                <div class="w-6/12">
                    <div class="text-end">
                        <img src="assets/images/banner_3.png" alt="images" class="hidden md:block">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <livewire:components.profile-browser
        :perPage="12"
        :onlyPublic="true"
        :filterByStatus="true"
    />
</div>
