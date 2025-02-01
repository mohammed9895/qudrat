@props(['layout', 'page' => null])
@php
    use App\Models\JobApplication;use App\Models\Profile;use SolutionForest\FilamentCms\Dto\CmsPageData;use SolutionForest\FilamentCms\Facades\FilamentCms;

    /** @var array $layout */
    /** @var ?CmsPageData $page */

    $theme = FilamentCms::getCurrentTheme();

    $profiles_count = Profile::count();

    $experts_count = Profile::where('is_expert', 1)->count();

    $jobs_count = JobApplication::count();

@endphp

<x-dynamic-component
    component="filament-cms::{{$theme}}.page"
    :layout="$layout">
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-[160px] pb-28">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-8/12">
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3"
                        style="">{{ $page->data['page_title'] }}</h2>
                    <p class="mb-6 leading-relaxed">{{ $page->data['page_description'] }}</p>
                </div>
                <div class="w-6/12">
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Image -->
    <div class="mt-[-60px]">
        <div class="container">
            <img src="storage/{{ $page->data['page_image'] }}" alt="image" class="w-full rounded-md">
        </div>
    </div>
    <!-- /Image -->

    <!-- Logo -->
    <div class="pt-24 pb-12">
        <div class="text-center">
            <h5 class="font-semibold text-xl mb-5">{{ $page->data['sponsors_title'] }}</h5>
        </div>
        <div class="px-10">
            <div class="flex items-center justify-center 2xl:justify-between gap-5 flex-wrap">
                @foreach($page->data['sponsors_images'] as $sponsor)
                    <img src="/storage/{{ $sponsor }}" alt="images"
                         class="opacity-50 hover:opacity-100 transition"/>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Logo -->

    <!-- Tab -->
    <div class="py-12">
        <div class="container">
            <div class="flex justify-center mb-9">
                <div class="lg:w-7/12">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl font-semibold">{{ $page->data['about_title'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex justify-center flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                    role="tablist">
                    @foreach($page->data['about_items'] as $item)
                        <li class="me-2" role="presentation">
                            <button
                                class="inline-block px-4 py-2 border-b-2 rounded-t-lg text-gray-500 hover:text-gray-600 hover:border-gray-300 aria-selected:text-brand-blue aria-selected:border-brand-blue"
                                id="profile-tab"
                                data-tabs-target="#tab-{{ $loop->index }}"
                                type="button"
                                role="tab"
                                aria-controls="tab-{{ $loop->index }}"
                                aria-selected="true"
                            >
                                {{ $item['title'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-12" id="default-tab-content">
                @foreach($page->data['about_items'] as $item)
                    <div class="" id="tab-{{ $loop->index }}" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="flex items-center justify-between gap-4 flex-wrap lg:flex-nowrap">
                            <div class="w-full lg:w-5/12 rtl:order-2">
                                <h2 class="text-4xl font-semibold mb-4">{{ $item['title'] }}</h2>
                                <div>
                                    {!!  $item['description']  !!}
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 rtl:order-1">
                                <div class="flex justify-end">
                                    <img src="/storage/{{ $item['image'] }}" alt="image" class="">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Tab -->

    <!-- Counter -->
    <div class="py-12">
        <div class="container">
            <div class="flex justify-center gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-4/12 xl:w-3/12">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl font-semibold mb-1">{{ $profiles_count }}+</h2>
                        <h6 class="text-xl font-semibold mb-4 text-brand-red">{{ __('general.about-page.counter.profiles-count') }}</h6>
                    </div>
                </div>
                <div class="w-full md:w-4/12 xl:w-3/12">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl font-semibold mb-1">{{ $experts_count }}+</h2>
                        <h6 class="text-xl font-semibold mb-4 text-brand-red">{{ __('general.about-page.counter.experts-count') }}</h6>
                    </div>
                </div>
                <div class="w-full md:w-4/12 xl:w-3/12">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl font-semibold mb-1">{{ $jobs_count }}+</h2>
                        <h6 class="text-xl font-semibold mb-4 text-brand-red">{{ __('general.about-page.counter.jobs-count') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Counter -->

    <!-- Platform -->
    <div class="py-12">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div class="w-full xl:w-5/12">
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['features_title'] }}</h2>
                    <p class="text-b-color mb-8">{{ $page->data['features_description'] }}</p>
                    <div class="flex flex-col gap-6">
                        @foreach($page->data['features'] as $feature)
                            <div class="bg-white px-7 py-5 rounded-xl hover:shadow-default transition-all">
                                <div class="flex items-center justify-between gap-4 flex-wrap">
                                    <div class="flex items-center gap-3">
                                        <div class="shrink-0">
                                            <img src="/storage/{{ $feature['icon'] }}" alt="image" class="">
                                        </div>
                                        <div>
                                            <h6 class="text-brand-green text-base font-semibold mb-0">{{ $feature['subtitle'] }}</h6>
                                            <h4 class="text-2xl font-semibold">{{$feature['title']}}</h4>
                                        </div>
                                    </div>
                                    <span
                                        class="inline-block w-[36px] h-[36px] bg-brand-green bg-opacity-50 hover:bg-opacity-100 rounded-full flex items-center justify-center">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M0.718519 15.3351C0.718519 15.3351 7.25344 8.79999 14.7269 1.32652M14.7269 1.32652C9.32811 6.72532 2.8156 2.20588 2.8156 2.20588M14.7269 1.32652C9.32811 6.72532 13.8475 13.2378 13.8475 13.2378"
                                            stroke="white" stroke-width="1.42857"></path>
                                    </svg>
                                </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-full xl:w-6/12 relative">
                    <div
                        class="w-[650px] h-[650px] absolute rounded-full border-dashed border-2 z-10 border-brand-green bg-brand-green/30 animate-spinoo">
                    </div>
                    <img src="/storage/{{ $page->data['features_image'] }}" alt="images"
                         class="relative w-[550px] z-30 mt-[50px] mr-[50px]">
                </div>
            </div>
        </div>
    </div>
    <!-- /Platform -->

    <!-- Feedback -->
    <div class="py-12">
        <div class="container">
            <div class="rounded-lg relative">
                <img src="/storage/{{ $page->data['testimonials_image'] }}" alt="images" class="min-h-[280px] w-full">
                <div class="pt-8 sm:pt-16 lg:pt-24 w-full flex justify-center absolute start-0 top-0">
                    <div class="xl:w-7/12 text-center px-6 xl:px-0">
                        <h2 class="text-white text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['testimonials_title'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="sm:px-8 mt-10 lg:mt-[-70px] 2xl:mt-[-150px]">
                <div class="feedback_slider swiper pb-4">
                    <div class="swiper-wrapper">
                        @foreach($page->data['testimonials'] as $testimonial)
                            <div class="swiper-slide">
                                <div class="bg-white p-7 rounded-2xl shadow-default">
                                    <p class="mb-4">{{ $testimonial['description'] }}</p>
                                    <div class="flex items-center gap-4">
                                        <div class="shrink-0">
                                            <img src="/storage/{{ $testimonial['image'] }}" alt="image" class="">
                                        </div>
                                        <div>
                                            <h6 class="text-sm font-semibold">{{ $testimonial['name'] }}</h6>
                                            <p class="text-xs">{{ $testimonial['position'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-center gap-4 mt-6">
                        <div
                            class="swiper_nav_prev w-[48px] h-[48px] bg-white hover:bg-primary-1 rounded-full flex items-center justify-center rtl:order-2">
                            <span>
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.3344 14.0526C14.3344 14.0526 8.06084 7.77895 0.886306 0.604417M0.886306 0.604417C6.06915 5.78726 12.3212 1.44861 12.3212 1.44861M0.886306 0.604417C6.06915 5.78726 1.7305 12.0393 1.7305 12.0393"
                                        stroke="#010101" stroke-width="1.37143"/>
                                </svg>
                            </span>
                        </div>
                        <div
                            class="swiper_nav_next w-[48px] h-[48px] bg-white hover:bg-primary-1 rounded-full flex items-center justify-center rtl:order-1">
                            <span>
                                <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1.08556 14.0526C1.08556 14.0526 7.35908 7.77895 14.5336 0.604417M14.5336 0.604417C9.35077 5.78726 3.09876 1.44861 3.09876 1.44861M14.5336 0.604417C9.35077 5.78726 13.6894 12.0393 13.6894 12.0393"
                                        stroke="#010101" stroke-width="1.37143"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Feedback -->


    <!-- Faq -->
    <div class="py-12">
        <div class="container">
            <div class="flex justify-center mb-9">
                <div class="lg:w-6/12">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['faq_title'] }}</h2>
                        <p>{{ $page->data['faq_description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="xl:w-8/12">
                    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-primary-1"
                         data-inactive-classes="text-b-color">

                        @foreach($page->data['faq'] as $faq)
                            <h2 id="accordion-flush-heading-1">
                                <button type="button"
                                        class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border-b border-gray-200 gap-3"
                                        data-accordion-target="#accordion-flush-body-{{ $loop->index }}"
                                        aria-expanded="true"
                                        aria-controls="accordion-flush-body-{{ $loop->index }}">
                                    <span>{{ $faq['question'] }}</span>
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="M9 5 5 1 1 5"/>
                                    </svg>
                                </button>
                            </h2>
                            <div id="accordion-flush-body-{{ $loop->index }}" class="hidden"
                                 aria-labelledby="accordion-flush-heading-1">
                                <div class="p-5 bg-white border-b border-gray-200">
                                    <p class="text-b-color">
                                        {{ $faq['answer'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Faq -->

    <!-- Post -->
    <div class="pt-12 pb-24">
        <div class="container">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 xl:col-span-6">
                    <div class="bg-white px-7 py-9 rounded-xl group relative z-10 hover:bg-primary-2 transition-all">
                            <span class="absolute end-0 bottom-0 -z-10 group-hover:opacity-10">
                                <svg width="251" height="154" viewBox="0 0 251 154" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="161.5" cy="161" r="161" fill="#EBF9F8"/>
                                </svg>
                            </span>
                        <h5 class="text-[28px] font-semibold mb-3 group-hover:text-white">{{ $page->data['cta_1_title'] }}</h5>
                        <p class="mb-6 group-hover:text-white">{{ $page->data['cta_1_description']  }}</p>
                        <a href="{{ $page->data['cta_1_button_link']  }}"
                           class="px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">{{ $page->data['cta_1_button_text']  }}</a>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <div class="bg-white px-7 py-9 rounded-xl group relative z-10 hover:bg-brand-blue transition-all">
                            <span class="absolute end-0 bottom-0 -z-10 group-hover:opacity-10">
                                <svg width="251" height="154" viewBox="0 0 251 154" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="161.5" cy="161" r="161" fill="#EBF9F8"/>
                                </svg>
                            </span>
                        <h5 class="text-[28px] font-semibold mb-3 group-hover:text-white">{{ $page->data['cta_2_title'] }}</h5>
                        <p class="mb-6 group-hover:text-white">{{ $page->data['cta_2_description']  }}</p>
                        <a href="{{ $page->data['cta_2_button_link']  }}"
                           class="px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">{{ $page->data['cta_2_button_text']  }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Post -->
</x-dynamic-component>
