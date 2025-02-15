<div
    class="flex items-center gap-2 text-black mb-5"
    x-data="{
        breadcrumbs: @js($breadcrumbs),

        init() {
            document.addEventListener('wireui::breadcrumbs', ({ detail }) => {
                this.breadcrumbs = detail
            })
        }
    }"
>
    <a href="{{ $home }}">
        <!-- Heroicons v2 home/outline -->
        {{ __('general.home') }}
    </a>

    <template x-for="trail in breadcrumbs" :key="trail.url + trail.label">
        <div class="flex items-center gap-2 text-gray-700 last:text-gray-400">
            <!-- Heroicons v2 chevron-right/outline -->
            <svg class="w-4 h-4 text-gray-400 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
            </svg>

            <a x-text="trail.label" class="text-gray-600" :href="trail.url && trail.url"></a>
        </div>
    </template>
</div>
