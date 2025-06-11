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


    <!-- Hero -->
    <div class="pt-24 px-6">
        <div
            class="bg-brand-blue/30 py-20 xl:py-[130px] rounded-[20px] relative overflow-hidden z-10 px-5 xl:px-0 hero-full">
            <div class="container">
                <div class="grid grid-cols-12 gap-4 flex justify-between items-center">
                    <div class="col-span-full xl:col-span-7">
                        <h1 class="text-4xl sm:text-[64px] font-bold sm:leading-[100px] mb-3 prose-strong:text-brand-blue">
                            {!! $page->data['main_title'] !!}
                        </h1>
                        <p class="text-xl mb-10 ">{{ $page->data['secondary_title'] }}</p>
                        <form action="{{ route('search') }}" class="relative max-w-[535px] mb-5">
                            <input type="text" name="search" class="bg-white w-full px-6 py-4 border-none rounded-full"
                                   placeholder="{{ __('general.hero.hero-search') }}">
                            <div class="flex items-center gap-2 absolute top-[4px] end-[6px]">
                                <!-- <select name="serachType" class="bg-transparent hero_select !px-5 hidden sm:block">
                                    <option selected value="talents">{{ __('general.talents') }}</option>
                                    <option value="experts">{{ __('general.experts') }}</option>
                                    <option value="job">{{ __('general.jobs') }}</option>
                                    <option value="works">{{ __('general.works') }}</option>
                                    <option value="researchers">{{ __('general.researchers') }}</option>
                                    <option value="innovators">{{ __('general.innovators') }}</option>
                                </select> -->
                                <button type="submit"
                                        class="w-[48px] h-[48px] bg-brand-blue rounded-full flex items-center justify-center">
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21 21.2764L16.7 16.9764M19 11.2764C19 15.6946 15.4183 19.2764 11 19.2764C6.58172 19.2764 3 15.6946 3 11.2764C3 6.85809 6.58172 3.27637 11 3.27637C15.4183 3.27637 19 6.85809 19 11.2764Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-span-full xl:col-span-5 hero-slider">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach($page->data['talents'] as $talent)
                                    <div class="swiper-slide relative pt-10 bg-[{{ $talent['background'] }}]">
                                        <div class="p-3 text-white" bis_skin_checked="1">
                                            <h3 class="font-bold text-2xl text-white mb-2">{{ $talent['name'] }}</h3>
                                            <h4 class="text-white text-lg">{{ $talent['category'] }}</h4>
                                        </div>

                                        <img src="/storage/{{ $talent['image'] }}"
                                             class="absolute bottom-0 z-50 h-[500px]"
                                             alt="">

                                        <div
                                            class="w-full h-3/4 bg-gradient-to-t from-[{{ $talent['background'] }}] via-[{{ $talent['background'] }}] to-transparent absolute bottom-0"></div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Hero -->


    <!-- Logo -->
    <div class="pt-24 pb-12">
        <div class="text-center">
            <h5 class="font-semibold text-xl mb-5">{{ $page->data['sponsors_title'] }}</h5>
        </div>
        <div class="px-10">
            <div class="flex items-center justify-center 2xl:justify-between gap-5 flex-wrap">
                @foreach($page->data['sponsors_images'] as $sponsor)
                    <img src="/storage/{{ $sponsor }}" alt="images" width="200"
                         class="opacity-50 hover:opacity-100 transition"/>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Logo -->


    <livewire:frontend.home.profiles :title="$page->data['talent_title']"
                                     :description="$page->data['talent_description']"
                                     :profiles_per_category="10"/>


    <!-- About -->
    <div class="bg-white py-24">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap lg:flex-nowrap">
                <div class="w-full lg:w-6/12 relative">
                    <img src="/storage/{{ $page->data['about_image'] }}" alt="images" class="">
                    <img src="{{ asset('assets/images/red-shape.svg') }}"
                         class="w-20 absolute top-32 -right-10"
                         alt="">

                    <img src="{{ asset('assets/images/yellow-shape.svg') }}"
                         class="w-20 absolute -top-10 left-2 rotate-120 "
                         alt="">

                    <img src="{{ asset('assets/images/green-shape.svg') }}"
                         class="w-20 absolute bottom-64 left-2 rotate-45 "
                         alt="">

                    <img src="{{ asset('assets/images/gray-shape.svg') }}"
                         class="w-10 absolute -bottom-10 left-3/4 rotate-45"
                         alt="">
                </div>
                <div class="w-full lg:w-6/12 xl:w-5/12">
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['about_title'] }}</h2>
                    <p class="text-b-color mb-10">{{ $page->data['about_description'] }}</p>
                    <div class="flex flex-col gap-8">
                        @foreach($page->data['about_items'] as $item)
                            <div class="flex gap-5 items-center">
                                <div
                                    class="shrink-0 bg-gradient-to-t from-brand-blue/30 to-transparent w-24 h-24 rounded-full flex justify-center items-center">
                                    <img src="/storage/{{ $item['image'] }}" alt="images" class="w-14">
                                </div>
                                <div>
                                    <h5 class="text-2xl font-medium mb-3">{{ $item['title'] }}</h5>
                                    <p>{{ $item['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /About -->


    <!-- Step -->
    <div class="pt-24 pb-12">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div class="w-full xl:w-5/12">
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $page->data['steps_title'] }}</h2>
                    <p class="text-b-color mb-10">{{ $page->data['steps_description'] }}</p>
                    <a href="{{ $page->data['steps_button_url'] }}"
                       class="px-8 py-3 rounded-full text-head-color font-medium bg-brand-red text-white inline-flex items-center gap-2">{{ $page->data['steps_button_text'] }}
                        <span><svg width="12" height="10" viewBox="0 0 12 10" fill="none"
                                   xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.991646 9.27349C0.991646 9.27349 6.25866 4.77968 11.0089 0.726747M11.0089 0.726747C7.57736 3.65456 3.95259 0.688952 3.95259 0.688952M11.0089 0.726747C7.57736 3.65456 9.9353 7.70104 9.9353 7.70104"
                            stroke="white" stroke-width="1.5"/>
                        </svg>
                        </span></a>
                </div>
                <div class="w-full xl:w-6/12">
                    <div class="grid grid-cols-12 gap-6">
                        @foreach($page->data['steps'] as $step)
                            <div class="col-span-12 md:col-span-6">
                                <div
                                    class="bg-transparent border-[3px] border-white rounded-xl p-5 hover:bg-white transition-all relative h-full">
                                    <h4 class="text-5xl font-bold text-brand-red text-opacity-25 absolute top-1 end-1">
                                        {{ $step['number'] }}</h4>
                                    <img src="/storage/{{ $step['image'] }}" alt="images" class="w-20 mb-3">
                                    <h6 class="text-xl font-semibold mb-2">{{ $step['title'] }}</h6>
                                    <p class="mb-4">{{ $step['description'] }}</p>
                                    <div class="flex justify-between">
                                        <span
                                            class="inline-block w-[36px] h-[36px] bg-brand-red bg-opacity-50 rounded-full flex items-center justify-center">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.718519 15.3351C0.718519 15.3351 7.25344 8.79999 14.7269 1.32652M14.7269 1.32652C9.32811 6.72532 2.8156 2.20588 2.8156 2.20588M14.7269 1.32652C9.32811 6.72532 13.8475 13.2378 13.8475 13.2378"
                                                stroke="white" stroke-width="1.42857"></path>
                                        </svg>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Step -->


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
                            class="swiper_nav_prev w-[48px] h-[48px] bg-white hover:bg-primary-1 rounded-full flex items-center justify-center">
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
                            class="swiper_nav_next w-[48px] h-[48px] bg-white hover:bg-primary-1 rounded-full flex items-center justify-center">
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
                        class="w-[650px] h-[650px] absolute rounded-full border-dashed border-2 z-10 border-brand-green bg-brand-green/30">
                    </div>
                    <img src="/storage/{{ $page->data['features_image'] }}" alt="images"
                         class="relative w-[550px] z-30 mt-[50px] mr-[50px]">
                </div>
            </div>
        </div>
    </div>
    <!-- /Platform -->


    <!-- Map -->
    <div class="py-12">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div class="w-full lg:w-6/12">
                    <div id="container-s"></div>
                </div>
                <div class="w-full lg:w-5/12">
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3 leading-[100px]">{{ $page->data['map_title'] }}</h2>
                    <p class="text-b-color mb-8 ">{{ $page->data['map_description'] }}</p>

                    <a href="{{ $page->data['map_button_url'] }}"
                       class="px-8 py-3 rounded-full text-head-color font-medium bg-black text-white inline-flex items-center gap-2">{{ $page->data['map_button_text'] }}
                        <span><svg width="12" height="10" viewBox="0 0 12 10" fill="none"
                                   xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.991646 9.27349C0.991646 9.27349 6.25866 4.77968 11.0089 0.726747M11.0089 0.726747C7.57736 3.65456 3.95259 0.688952 3.95259 0.688952M11.0089 0.726747C7.57736 3.65456 9.9353 7.70104 9.9353 7.70104"
                            stroke="white" stroke-width="1.5"></path>
                        </svg>
                    </span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Map -->


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
