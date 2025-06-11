<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-24 md:pt-10 pb-5">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.digital-library.main-title') }}</h2>
                </div>
                <div class="w-6/12">
                    <div class="text-end">
                        <img src="/assets/images/banner_1.png" alt="images" class="hidden md:block">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Card & Siderbar -->
    <div class="pt-24 pb-12">
        <div class="container">
            <div class="grid grid-cols-12 gap-5">

                <div class="col-span-full md:col-span-4 xl:col-span-3">
                    <div class="bg-white p-6 rounded-xl">
                        <h6 class="text-lg font-semibold mb-3">{{ __('general.search') }}</h6>
                        <div class="">
                            <input type="text" wire:model.live.debounce.150ms="search"
                                   class="w-full border border-gray-1 rounded-xl p-3 focus:border-[#3cc7bc] focus:ring-[#3cc7bc]"
                                   placeholder="{{ __('general.search-placeholder') }}">
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl mt-5">
                        <h6 class="text-lg font-semibold mt-3 mb-3">{{ __('general.footer.categories') }}</h6>
                        <div class="">
                            @foreach($categories as $category)
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="{{ $category->id }}"
                                           wire:model.live="categoriesList"
                                           class="peer w-4 h-4 text-primary-2 bg-white border-gray-300 rounded focus:ring-transparent focus:ring-2">
                                    <label for="default-checkbox"
                                           class="ms-2 text-sm font-medium text-b-color peer-checked:text-primary-2 w-full flex items-center">
                                        {{ $category->name }}
                                        <span
                                            class="inline-block ms-auto">({{ $category->posts_count }})</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{--                        <div class="filter_section filter_age mt-6">--}}
                        {{--                            <strong class="text-button text-primary">--}}
                        {{--                                <span class="text-black">Age: </span>--}}
                        {{--                                <span class="age_min">0</span>--}}
                        {{--                                <span> - </span>--}}
                        {{--                                <span class="age_max">60</span>--}}
                        {{--                                <span>years old</span>--}}
                        {{--                            </strong>--}}
                        {{--                            <div class="tow_bar_block mt-5">--}}
                        {{--                                <div class="progress"></div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="range_input">--}}
                        {{--                                <input class="input range_min" type="range" min="0" max="60" value="0" />--}}
                        {{--                                <input class="input range_max" type="range" min="0" max="60" value="60" />--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="col-span-full xl:col-span-9">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        @foreach($this->posts as $post)
                            <div class="">
                                <div class="bg-white p-5 rounded-xl shadow-default">
                                    <img src="{{ $post->getThumbnailImage() }}" alt="images"
                                         class="w-full mb-4 rounded-md">
                                    <a href=""
                                       class="inline-block text-2xl font-medium mb-3 hover:text-primary-1">{{ $post->title }}</a>
                                    <p class="mb-4">{{ substr(strip_tags($post->description), 0, 300) }}...</p>
                                    <a href="{{ route('digital-library.post', [$post->digitalLibraryCategory,$post]) }}"
                                       class="inline-block px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">{{ __('general.view-resoucre') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $this->posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Card & Siderbar -->

    {{--    <!-- Recommendation -->--}}
    {{--    <div class="pt-12 pb-24">--}}
    {{--        <div class="container">--}}
    {{--            <div class="text-center mb-9">--}}
    {{--                <h2 class="text-4xl sm:text-5xl font-semibold mb-3">Recommendation </h2>--}}
    {{--                <p>The best featured Popular e-books, articles, and videos</p>--}}
    {{--            </div>--}}
    {{--            <div class="flex items-center gap-4 flex-wrap xl:flex-nowrap">--}}
    {{--                <div class="w-full xl:w-5/12">--}}
    {{--                    <img src="/assets/images/recom_img.png" alt="image" class="max-h-[600px]">--}}
    {{--                </div>--}}
    {{--                <div class="w-full xl:w-7/12">--}}
    {{--                    <div class="grid grid-cols-12 gap-4 lg:gap-6">--}}
    {{--                        <div class="col-span-12 md:col-span-6">--}}
    {{--                            <div--}}
    {{--                                class="bg-transparent border-[3px] border-white rounded-xl p-5 relative hover:bg-white transition-all relative h-full">--}}
    {{--                                <h4 class="text-5xl font-bold text-primary-1 text-opacity-25 absolute top-1 end-1">--}}
    {{--                                    01</h4>--}}
    {{--                                <img src="/assets/images/step_1.png" alt="images" class=" mb-3">--}}
    {{--                                <h6 class="text-xl font-semibold mb-2">Create Your resume</h6>--}}
    {{--                                <p class="mb-6">Keep track of tenant information and Our app allows all necessary.</p>--}}
    {{--                                <div class="flex justify-between">--}}
    {{--                                    <a href="#"--}}
    {{--                                       class="inline-block px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">View--}}
    {{--                                        Resource</a>--}}
    {{--                                    <span--}}
    {{--                                        class="inline-block w-[36px] h-[36px] bg-primary-1 bg-opacity-50 rounded-full flex items-center justify-center">--}}
    {{--                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"--}}
    {{--                                                 xmlns="http://www.w3.org/2000/svg">--}}
    {{--                                                <path--}}
    {{--                                                    d="M0.718519 15.3351C0.718519 15.3351 7.25344 8.79999 14.7269 1.32652M14.7269 1.32652C9.32811 6.72532 2.8156 2.20588 2.8156 2.20588M14.7269 1.32652C9.32811 6.72532 13.8475 13.2378 13.8475 13.2378"--}}
    {{--                                                    stroke="white" stroke-width="1.42857"></path>--}}
    {{--                                            </svg>--}}
    {{--                                        </span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-span-12 md:col-span-6">--}}
    {{--                            <div--}}
    {{--                                class="bg-transparent border-[3px] border-white rounded-xl p-5 relative hover:bg-white transition-all relative h-full">--}}
    {{--                                <h4 class="text-5xl font-bold text-primary-1 text-opacity-25 absolute top-1 end-1">--}}
    {{--                                    02</h4>--}}
    {{--                                <img src="/assets/images/step_1.png" alt="images" class=" mb-3">--}}
    {{--                                <h6 class="text-xl font-semibold mb-2">Job Fit Scoring</h6>--}}
    {{--                                <p class="mb-6">Keep track of tenant information and Our app allows all necessary.</p>--}}
    {{--                                <div class="flex justify-between">--}}
    {{--                                    <a href="#"--}}
    {{--                                       class="inline-block px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">View--}}
    {{--                                        Resource</a>--}}
    {{--                                    <span--}}
    {{--                                        class="inline-block w-[36px] h-[36px] bg-primary-1 bg-opacity-50 rounded-full flex items-center justify-center">--}}
    {{--                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"--}}
    {{--                                                 xmlns="http://www.w3.org/2000/svg">--}}
    {{--                                                <path--}}
    {{--                                                    d="M0.718519 15.3351C0.718519 15.3351 7.25344 8.79999 14.7269 1.32652M14.7269 1.32652C9.32811 6.72532 2.8156 2.20588 2.8156 2.20588M14.7269 1.32652C9.32811 6.72532 13.8475 13.2378 13.8475 13.2378"--}}
    {{--                                                    stroke="white" stroke-width="1.42857"></path>--}}
    {{--                                            </svg>--}}
    {{--                                        </span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-span-12 md:col-span-6">--}}
    {{--                            <div--}}
    {{--                                class="bg-transparent border-[3px] border-white rounded-xl p-5 relative hover:bg-white transition-all relative h-full">--}}
    {{--                                <h4 class="text-5xl font-bold text-primary-1 text-opacity-25 absolute top-1 end-1">--}}
    {{--                                    03</h4>--}}
    {{--                                <img src="/assets/images/step_1.png" alt="images" class=" mb-3">--}}
    {{--                                <h6 class="text-xl font-semibold mb-2">Salary Estimate</h6>--}}
    {{--                                <p class="mb-6">Keep track of tenant information and Our app allows all necessary.</p>--}}
    {{--                                <div class="flex justify-between">--}}
    {{--                                    <a href="#"--}}
    {{--                                       class="inline-block px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">View--}}
    {{--                                        Resource</a>--}}
    {{--                                    <span--}}
    {{--                                        class="inline-block w-[36px] h-[36px] bg-primary-1 bg-opacity-50 rounded-full flex items-center justify-center">--}}
    {{--                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"--}}
    {{--                                                 xmlns="http://www.w3.org/2000/svg">--}}
    {{--                                                <path--}}
    {{--                                                    d="M0.718519 15.3351C0.718519 15.3351 7.25344 8.79999 14.7269 1.32652M14.7269 1.32652C9.32811 6.72532 2.8156 2.20588 2.8156 2.20588M14.7269 1.32652C9.32811 6.72532 13.8475 13.2378 13.8475 13.2378"--}}
    {{--                                                    stroke="white" stroke-width="1.42857"></path>--}}
    {{--                                            </svg>--}}
    {{--                                        </span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-span-12 md:col-span-6">--}}
    {{--                            <div--}}
    {{--                                class="bg-transparent border-[3px] border-white rounded-xl p-5 relative hover:bg-white transition-all relative h-full">--}}
    {{--                                <h4 class="text-5xl font-bold text-primary-1 text-opacity-25 absolute top-1 end-1">--}}
    {{--                                    04</h4>--}}
    {{--                                <img src="/assets/images/step_1.png" alt="images" class=" mb-3">--}}
    {{--                                <h6 class="text-xl font-semibold mb-2">Production Operation</h6>--}}
    {{--                                <p class="mb-6">Keep track of tenant information and Our app allows all necessary.</p>--}}
    {{--                                <div class="flex justify-between">--}}
    {{--                                    <a href="#"--}}
    {{--                                       class="inline-block px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">View--}}
    {{--                                        Resource</a>--}}
    {{--                                    <span--}}
    {{--                                        class="inline-block w-[36px] h-[36px] bg-primary-1 bg-opacity-50 rounded-full flex items-center justify-center">--}}
    {{--                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"--}}
    {{--                                                 xmlns="http://www.w3.org/2000/svg">--}}
    {{--                                                <path--}}
    {{--                                                    d="M0.718519 15.3351C0.718519 15.3351 7.25344 8.79999 14.7269 1.32652M14.7269 1.32652C9.32811 6.72532 2.8156 2.20588 2.8156 2.20588M14.7269 1.32652C9.32811 6.72532 13.8475 13.2378 13.8475 13.2378"--}}
    {{--                                                    stroke="white" stroke-width="1.42857"></path>--}}
    {{--                                            </svg>--}}
    {{--                                        </span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <!-- /Recommendation -->--}}
</div>
