@props(['layout', 'page' => null])
@php
    use SolutionForest\FilamentCms\Dto\CmsPageData;use SolutionForest\FilamentCms\Facades\FilamentCms;

    /** @var array $layout */
    /** @var ?CmsPageData $page */

    $theme = FilamentCms::getCurrentTheme();
@endphp

<x-dynamic-component
    component="filament-cms::{{$theme}}.page"
    :layout="$layout">
    <script defer src="//unpkg.com/alpinejs"></script>


    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-[160px] pb-28">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    {{--                    <x-breadcrumbs/>--}}
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->title }}</h2>
                    {{--                    {{ __('general.international-talent-request.description') }}--}}
                </div>
                <div class="w-6/12">
                </div>
            </div>
        </div>
    </div>
    <div class="py-24">
        <div class="container">
            <div class="prose max-w-none dark:prose-invert">
                {!!  $page->data['content']  !!}
            </div>

        </div>
    </div>


</x-dynamic-component>
