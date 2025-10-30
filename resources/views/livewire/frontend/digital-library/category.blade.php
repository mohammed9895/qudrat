<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-24 md:pt-10 pb-5">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $category->name }}</h2>
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
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($this->posts as $post)
                    <div class="">
                        <div class="bg-white p-5 rounded-xl shadow-default">
                            <img src="{{ $post->getThumbnailImage() }}" alt="images" class="w-full mb-4 rounded-md">
                            <a href=""
                               class="inline-block text-2xl font-medium mb-3 hover:text-primary-1">{{ $post->title }}</a>
                            <p class="mb-4">{{ $category->description }}</p>
                            <a href="{{ route('digital-library.post', [$category,$post]) }}"
                               class="inline-block px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">View
                                Resource</a>
                        </div>
                    </div>
                @endforeach
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
