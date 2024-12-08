<div
    class="flex items-center gap-2 text-slate-600 mb-5"
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
        <svg class="w-5 h-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
    </a>

    <template x-for="trail in breadcrumbs" :key="trail.url + trail.label">
        <div class="flex items-center gap-2 text-gray-700 last:text-gray-400">
            <!-- Heroicons v2 chevron-right/outline -->
            <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>

            <a x-text="trail.label" :href="trail.url && trail.url"></a>
        </div>
    </template>
</div>
