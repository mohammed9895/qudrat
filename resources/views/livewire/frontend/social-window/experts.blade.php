<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-[160px] pb-28">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.experts') }}</h2>
                    <h2 class="mt-5 text-xl">{{ __('general.expert.sub-title') }}</h2>
                </div>
                <div class="w-6/12">
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->
    <livewire:components.profile-browser
        :perPage="12"
        :onlyPublic="true"
        :filterByStatus="true"
        :onlyExperts="true"
    />
</div>
