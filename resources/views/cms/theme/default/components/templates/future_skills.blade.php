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


    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-24 md:pt-14 pb-5">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <div class="flex items-center gap-3 mb-3">
                        <a href="" class="text-head-color text-sm">{{ __('general.navigation.home') }}</a>
                        <span class="text-gray-3 text-sm">/</span>
                        <span class="text-b-color text-sm">{{ $page->title }}</span>
                    </div>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->title }}</h2>
                    <h3 class="mt-5 text-xl">{{ __('general.future-skills.sub-title') }}</h3>
                </div>
                <div class="w-6/12">
                    <div class="flex justify-end">
                        <img src="assets/images/banner_6.png" alt="images" class="hidden md:block">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Card -->
    <div class="pt-24 pb-12">
        <div class="container">
            <div class="flex justify-center mb-9">
                <div class="lg:w-6/12">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['main_title'] }}</h2>
                        <p>{{ $page->data['main_description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($page->data['categories'] as $category)
                    <a href="{{ $category['link'] }}" class="">
                        <div class="group bg-white hover:bg-brand-blue transition-all px-4 py-6 rounded-2xl h-full">
                            <div class="text-center flex items-center justify-center flex-col">
                                <x-icon name="{{ $category['icon'] }}" class="size-28 text-brand-green mb-5"/>
                                <h4 class="text-2xl font-medium group-hover:text-white">{{ $category['title'] }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Card -->

    <!-- Feature Skills -->
    <div class="py-12">
        <div class="container">
            <div class="flex mb-9">
                <div class="lg:w-7/12">
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['recommendation_title'] }}</h2>
                    <p>{{ $page->data['recommendation_description'] }}</p>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4">
                @foreach($page->data['recommendation_items'] as $item)
                    <div class="col-span-full lg:col-span-6 xl:col-span-3">
                        <div class="bg-white p-5 rounded-xl shadow-default">
                            <img src="assets/images/blog_1.png" alt="images" class="w-full mb-4">
                            <a href=""
                               class="inline-block text-2xl font-medium mb-3 hover:text-primary-1">{{ $item['title'] }}</a>
                            {!!  substr($item['content'], 0 ,100)  !!}
                            <a href="{{ $item['link'] }}"
                               class="inline-block px-8 py-3 mt-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">{{ __('general.future-skills.know-more') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Feature Skills -->

    <!-- Chart -->
    <div class="pt-12 pb-24">
        <div class="container">
            <div class="flex justify-center mb-9">
                <div class="lg:w-6/12">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['chart_main_title'] }}</h2>
                        <p>{{ $page->data['chart_main_description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 xl:grid-cols-5 gap-5 xl:gap-0">
                <div class="flex flex-col justify-end">
                    <div class="flex justify-center mb-5">
                        <svg width="79" height="302" viewBox="0 0 79 302" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" width="78" height="302" rx="24" fill="#2E3192"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h5 class="text-2xl font-medium">Artificial Intelligence
                            and Data Science</h5>
                    </div>
                </div>
                <div class="flex flex-col justify-end">
                    <div class="flex justify-center mb-5">
                        <svg width="79" height="214" viewBox="0 0 79 214" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" width="78" height="214" rx="24" fill="#EAAA08"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h5 class="text-2xl font-medium">Healthcare <br>
                            Technology</h5>
                    </div>
                </div>
                <div class="flex flex-col justify-end">
                    <div class="flex justify-center mb-5">
                        <svg width="78" height="255" viewBox="0 0 78 255" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect width="78" height="255" rx="24" fill="#17B26A"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h5 class="text-2xl font-medium">Sustainability and Renewable Energy</h5>
                    </div>
                </div>
                <div class="flex flex-col justify-end">
                    <div class="flex justify-center mb-5">
                        <svg width="79" height="224" viewBox="0 0 79 224" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" width="78" height="224" rx="24" fill="#66C61C"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h5 class="text-2xl font-medium">Quantum <br> Computing</h5>
                    </div>
                </div>
                <div class="flex flex-col justify-end">
                    <div class="flex justify-center mb-5">
                        <svg width="78" height="166" viewBox="0 0 78 166" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect width="78" height="166" rx="24" fill="#875BF7"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <h5 class="text-2xl font-medium">Space <br> Technology</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Chart -->

</x-dynamic-component>
