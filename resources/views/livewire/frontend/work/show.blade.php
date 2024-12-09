<div>
    <!-- Banner -->
    <div class="bg-primary-3 pt-[160px] pb-28">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs />
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $work->title }}</h2>
                </div>
                <div class="w-6/12">
                    <div class="flex items-center justify-end space-x-3">
                        <a href="#" class="w-12 h-12 rounded-full bg-primary-4 text-white items-center justify-center flex">
                            <x-hugeicons-share-08 />
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full bg-primary-4 text-white items-center justify-center flex">
                            <x-heroicon-o-heart class="w-6 h-6" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->


    <!-- Sidebar & Content -->
    <div class="pb-24 mt-[-80px]">
        <div class="container">
            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-full xl:col-span-3">
                    <div class="bg-white p-6 rounded-xl relative">
                        <div class="bg-primary-2 px-4 py-2 rounded-full absolute top-[20px] right-[20px]">
                            <div class="flex items-center gap-1">
                                    <span>
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.1809 7.67695L12.3621 10.1369L13.2065 13.7994C13.2512 13.9909 13.2384 14.1913 13.1698 14.3756C13.1013 14.5598 12.9799 14.7198 12.8209 14.8354C12.6619 14.9511 12.4723 15.0173 12.2759 15.0258C12.0795 15.0343 11.8849 14.9847 11.7165 14.8832L8.52212 12.9457L5.33462 14.8832C5.16623 14.9847 4.97166 15.0343 4.77523 15.0258C4.57881 15.0173 4.38924 14.9511 4.23024 14.8354C4.07125 14.7198 3.94986 14.5598 3.88128 14.3756C3.81269 14.1913 3.79994 13.9909 3.84462 13.7994L4.68775 10.1407L1.86837 7.67695C1.71925 7.54834 1.61142 7.37856 1.55841 7.18891C1.50539 6.99926 1.50955 6.79818 1.57036 6.61089C1.63116 6.42359 1.74592 6.25842 1.90022 6.13608C2.05453 6.01374 2.24152 5.93969 2.43775 5.9232L6.154 5.60132L7.60462 2.14132C7.68038 1.95977 7.80815 1.80469 7.97186 1.69561C8.13558 1.58653 8.3279 1.52832 8.52462 1.52832C8.72135 1.52832 8.91367 1.58653 9.07738 1.69561C9.24109 1.80469 9.36887 1.95977 9.44462 2.14132L10.8996 5.60132L14.6146 5.9232C14.8109 5.93969 14.9978 6.01374 15.1521 6.13608C15.3065 6.25842 15.4212 6.42359 15.482 6.61089C15.5428 6.79818 15.547 6.99926 15.494 7.18891C15.4409 7.37856 15.3331 7.54834 15.184 7.67695H15.1809Z" fill="#F4AA1A"></path>
                                        </svg>
                                    </span>
                                <p class="text-white text-sm">
                                    <span class="font-semibold">{{ $work->profile->rating() }}</span> ({{ $work->profile->ratings->count() }})
                                </p>
                            </div>
                        </div>
                        <img src="/storage/{{ $work->profile->avatar }}" width="120" alt="image" class="mb-5 rounded-full border-2">
                        <h4 class="text-xl font-medium mb-1">{{$work->profile->fullname }}</h4>
                        <p class="text-sm mb-5">{{ $work->profile->position }}</p>
                        <ul class="flex flex-col gap-3 mb-8">
                            <li class="flex items-center gap-2">
                                    <span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.5 8.33301C17.5 14.1663 10 19.1663 10 19.1663C10 19.1663 2.5 14.1663 2.5 8.33301C2.5 6.34388 3.29018 4.43623 4.6967 3.02971C6.10322 1.62318 8.01088 0.833008 10 0.833008C11.9891 0.833008 13.8968 1.62318 15.3033 3.02971C16.7098 4.43623 17.5 6.34388 17.5 8.33301Z" stroke="#344054" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 10.833C11.3807 10.833 12.5 9.71372 12.5 8.33301C12.5 6.9523 11.3807 5.83301 10 5.83301C8.61929 5.83301 7.5 6.9523 7.5 8.33301C7.5 9.71372 8.61929 10.833 10 10.833Z" stroke="#344054" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                <p>{{ $work->profile->address }}</p>
                            </li>
                            <li class="flex items-center gap-2">
                                    <span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.33268 3.33301H16.666C17.5827 3.33301 18.3327 4.08301 18.3327 4.99967V14.9997C18.3327 15.9163 17.5827 16.6663 16.666 16.6663H3.33268C2.41602 16.6663 1.66602 15.9163 1.66602 14.9997V4.99967C1.66602 4.08301 2.41602 3.33301 3.33268 3.33301Z" stroke="#344054" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.3346 5L10.0013 10.8333L1.66797 5" stroke="#344054" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                <p><a href="mailto:{{ $work->profile->email }}">{{ $work->profile->email }}</a></p>
                            </li>
                            <li class="flex items-center gap-2">
                                    <span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.3332 14.1004V16.6004C18.3341 16.8325 18.2866 17.0622 18.1936 17.2749C18.1006 17.4875 17.9643 17.6784 17.7933 17.8353C17.6222 17.9922 17.4203 18.1116 17.2005 18.186C16.9806 18.2603 16.7477 18.288 16.5165 18.2671C13.9522 17.9884 11.489 17.1122 9.32486 15.7087C7.31139 14.4293 5.60431 12.7222 4.32486 10.7087C2.91651 8.53474 2.04007 6.05957 1.76653 3.48374C1.7457 3.2533 1.77309 3.02104 1.84695 2.80176C1.9208 2.58248 2.03951 2.38098 2.1955 2.21009C2.3515 2.0392 2.54137 1.90266 2.75302 1.80917C2.96468 1.71569 3.19348 1.66729 3.42486 1.66707H5.92486C6.32928 1.66309 6.72136 1.80631 7.028 2.07002C7.33464 2.33373 7.53493 2.69995 7.59153 3.10041C7.69705 3.90046 7.89274 4.68601 8.17486 5.44207C8.28698 5.74034 8.31125 6.0645 8.24478 6.37614C8.17832 6.68778 8.02392 6.97383 7.79986 7.20041L6.74153 8.25874C7.92783 10.345 9.65524 12.0724 11.7415 13.2587L12.7999 12.2004C13.0264 11.9764 13.3125 11.8219 13.6241 11.7555C13.9358 11.689 14.2599 11.7133 14.5582 11.8254C15.3143 12.1075 16.0998 12.3032 16.8999 12.4087C17.3047 12.4658 17.6744 12.6697 17.9386 12.9817C18.2029 13.2936 18.3433 13.6917 18.3332 14.1004Z" stroke="#344054" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                <p><a href="tel:{{ $work->profile->phone }}">{{ $work->profile->phone }}</a></p>
                            </li>
                        </ul>
                        <a href="{{ route('profile.index', $work->profile) }}" class="px-8 py-3 rounded-full text-head-color font-medium bg-primary-2 text-white inline-flex items-center gap-2 w-full justify-center">
                                <span><x-hugeicons-profile-02 class="size-6" /></span>
                            Visit Profile
                        </a>
                       @if($work->link)
                            <a href="{{ $work->link }}" class="px-8 py-3 mt-2 rounded-full text-[#2e3192] font-medium border-2 border-primary-2 text-white inline-flex items-center gap-2 w-full justify-center">
                                <span><x-hugeicons-link-04 class="size-6" /></span>
                                View Project
                            </a>
                       @endif
                    </div>
                    <div class="bg-white p-6 rounded-xl mt-5">
                        <h6 class="text-lg font-semibold mb-3">Attachments</h6>
                        <div class="flex items-center gap-3 flex-wrap">
                            @foreach($work->attachment_file_names as $attachment => $name)
                                <a wire:click="$dispatch('download-attachment', $attachment)" class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer flex items-center justify-center space-x-2">
                                    <x-hugeicons-download-01 />
                                    <span>{{ $name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl mt-5">
                        <h6 class="text-lg font-semibold mb-3">Tags</h6>
                        <div class="flex items-center gap-3 flex-wrap">
                            @foreach($work->workTags as $tag)
                                <a href="{{ route('social-window.index') }}" class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-full xl:col-span-9">
                    <div class="bg-white p-6 rounded-xl">
                        <div class="images overflow-hidden w-full">
                            <div class="swiper swiper-thumb-images section-swiper-navigation rounded-xl relative max-h-[400px]" >
                                <button class="custom-button-prev size-12 rounded-full -border lg:left-6 left-4 absolute z-50 top-1/2 bg-white flex items-center justify-center">
                                    @svg('hugeicons-arrow-left-04', 'size-8')
                                </button>
                                <div class="swiper-wrapper">
                                    @foreach($work->images as $image)
                                        <div class="swiper-slide">
                                            <img src="/storage/{{ $image }}" alt="blog/1" class="w-full h-full object-cover" />
                                        </div>
                                    @endforeach
                                </div>
                                <button class="custom-button-next size-12 bg-white rounded-full absolute z-50 top-1/2 -border lg:right-6 right-4 flex items-center justify-center">
                                    @svg('hugeicons-arrow-right-04', 'size-8')
                                </button>
                            </div>
                            <div thumbsSlider="" class="swiper swiper-list-images mt-4">
                                <div class="swiper-wrapper">
                                    @foreach($work->images as $image)
                                        <div class="swiper-slide overflow-hidden rounded-lg">
                                            <img src="/storage/{{ $image }}" alt="blog/1" class="w-full h-full object-cover" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h3 class="text-2xl font-semibold mb-3">Description</h3>
                           <div class="leading-loose mb-3">{!!  $work->description  !!}</div>
                            @if($work->videos)
                                <h3 class="text-2xl font-semibold mb-3">Video</h3>
                                <div class="relative">
                                    <video controls class="rounded-lg">
                                        <source src="/storage/{{ $work->videos }}" >
                                    </video>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Sidebar & Content -->

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var swiperListServiceDetail = new Swiper(".swiper-list-images", {
                loop: true,
                spaceBetween: 12,
                slidesPerView: 3,
                watchSlidesProgress: true,
                breakpoints: {
                    640: {
                        slidesPerView: 4,
                        spaceBetween: 16,
                    },
                },
            });

            var swiperThumbServiceDetail = new Swiper(".swiper-thumb-images", {
                loop: true,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".custom-button-next",
                    prevEl: ".custom-button-prev",
                },
                thumbs: {
                    swiper: swiperListServiceDetail,
                },
            });
        </script>
</div>
