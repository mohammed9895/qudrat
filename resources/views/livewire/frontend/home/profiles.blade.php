<!-- Talents -->
<div class="pt-12 pb-24">
    <div class="container">
        <div class="flex justify-center mb-6">
            <div class="lg:w-6/12">
                <div class="text-center">
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $title }}</h2>
                    <p>{{ $title_description }}</p>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" role="tablist">
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block px-4 py-2 border-b-2 rounded-t-lg text-gray-500 hover:text-gray-600 hover:border-gray-300 aria-selected:text-primary-1 aria-selected:border-primary-1"
                            id="profile-tab"
                            data-tabs-target="#profile"
                            type="button"
                            role="tab"
                            aria-controls="profile"
                            aria-selected="true"
                        >
                            Design/ Creative
                        </button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block px-4 py-2 border-b-2 rounded-t-lg text-gray-500 hover:text-gray-600 hover:border-gray-300 aria-selected:text-primary-1 aria-selected:border-primary-1"
                            id="dashboard-tab"
                            data-tabs-target="#dashboard"
                            type="button"
                            role="tab"
                            aria-controls="dashboard"
                            aria-selected="false"
                        >
                            Web Developer
                        </button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block px-4 py-2 border-b-2 rounded-t-lg text-gray-500 hover:text-gray-600 hover:border-gray-300 aria-selected:text-primary-1 aria-selected:border-primary-1"
                            id="settings-tab"
                            data-tabs-target="#settings"
                            type="button"
                            role="tab"
                            aria-controls="settings"
                            aria-selected="false"
                        >
                            Accounts
                        </button>
                    </li>
                    <li role="presentation">
                        <button
                            class="inline-block px-4 py-2 border-b-2 rounded-t-lg text-gray-500 hover:text-gray-600 hover:border-gray-300 aria-selected:text-primary-1 aria-selected:border-primary-1"
                            id="contacts-tab"
                            data-tabs-target="#contacts"
                            type="button"
                            role="tab"
                            aria-controls="contacts"
                            aria-selected="false"
                        >
                            Production/Operation
                        </button>
                    </li>
                </ul>
            </div>
            <div class="nav_btn flex items-center hidden lg:flex">
                <a href="{{ route('social-window.index') }}"
                   class="px-8 py-3 rounded-full border border-primary-1 text-head-color font-medium hover:bg-primary-1 hover:text-white">View
                    all talent</a>
                <span
                    class="inline-block w-[48px] h-[48px] bg-primary-1 rounded-full flex items-center justify-center">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.718519 15.3351C0.718519 15.3351 7.25344 8.79999 14.7269 1.32652M14.7269 1.32652C9.32811 6.72532 2.8156 2.20588 2.8156 2.20588M14.7269 1.32652C9.32811 6.72532 13.8475 13.2378 13.8475 13.2378"
                                stroke="white" stroke-width="1.42857"/>
                        </svg>
                    </span>
            </div>
        </div>
    </div>
    <div class="px-6 mt-7 overflow-hidden">
        <div id="default-tab-content">
            <div class="" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="talents_slider swiper pt-5 pb-14 xl:me-[-225px]">
                    <div class="swiper-wrapper">
                        @foreach($talents as $talent)
                            <div class="swiper-slide">
                                <div
                                    class="bg-transparent border-[3px] border-white rounded-xl p-7 relative hover:bg-white transition-all">
                                    <div
                                        class="bg-primary-2 px-4 py-2 rounded-full absolute top-[-20px] right-[25px]">
                                        <div class="flex items-center gap-1">
                                            <span>
                                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.1809 7.67695L12.3621 10.1369L13.2065 13.7994C13.2512 13.9909 13.2384 14.1913 13.1698 14.3756C13.1013 14.5598 12.9799 14.7198 12.8209 14.8354C12.6619 14.9511 12.4723 15.0173 12.2759 15.0258C12.0795 15.0343 11.8849 14.9847 11.7165 14.8832L8.52212 12.9457L5.33462 14.8832C5.16623 14.9847 4.97166 15.0343 4.77523 15.0258C4.57881 15.0173 4.38924 14.9511 4.23024 14.8354C4.07125 14.7198 3.94986 14.5598 3.88128 14.3756C3.81269 14.1913 3.79994 13.9909 3.84462 13.7994L4.68775 10.1407L1.86837 7.67695C1.71925 7.54834 1.61142 7.37856 1.55841 7.18891C1.50539 6.99926 1.50955 6.79818 1.57036 6.61089C1.63116 6.42359 1.74592 6.25842 1.90022 6.13608C2.05453 6.01374 2.24152 5.93969 2.43775 5.9232L6.154 5.60132L7.60462 2.14132C7.68038 1.95977 7.80815 1.80469 7.97186 1.69561C8.13558 1.58653 8.3279 1.52832 8.52462 1.52832C8.72135 1.52832 8.91367 1.58653 9.07738 1.69561C9.24109 1.80469 9.36887 1.95977 9.44462 2.14132L10.8996 5.60132L14.6146 5.9232C14.8109 5.93969 14.9978 6.01374 15.1521 6.13608C15.3065 6.25842 15.4212 6.42359 15.482 6.61089C15.5428 6.79818 15.547 6.99926 15.494 7.18891C15.4409 7.37856 15.3331 7.54834 15.184 7.67695H15.1809Z"
                                                        fill="#F4AA1A"/>
                                                </svg>
                                            </span>
                                            <p class="text-white text-sm">
                                                <span class="font-semibold">{{ $talent->rating() ?? 0 }}</span>
                                                ({{ $talent->ratings->count() }})
                                            </p>
                                        </div>
                                    </div>
                                    <div class="relative inline-block mb-4">
                                        <div class="size-24 rounded-full"
                                             style="background: url({{ $talent->getThumbnailImage() }}); background-size: cover; background-position: center center;"></div>
                                        <div
                                            class="bg-success w-3 h-3 rounded-full border-2 border-white absolute end-[10px] bottom-[5px]"></div>
                                    </div>
                                    <h4 class="text-xl font-medium mb-2">{{ $talent->fullname }}</h4>
                                    <p class="text-sm mb-4">{{ $talent->position }}</p>
                                    @if($talent->skills)
                                        <div class="flex items-center gap-1 flex-wrap mb-4">
                                            @foreach($talent->skills as $skill)
                                                <span
                                                    class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <p class="mb-6">{{ substr($talent->bio, 0 ,100) }}</p>
                                    <a href="{{ route('profile.index', $talent->username) }}"
                                       class="inline-block px-8 py-3 rounded-full border border-primary-1 text-head-color font-medium hover:bg-primary-1 hover:text-white">View
                                        Profile</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="hidden" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated
                        content</strong>. Clicking another tab will toggle the visibility of this one for the next.
                    The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript
                    swaps classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript
                    swaps classes to control the content visibility and styling.</p>
            </div>
        </div>
    </div>
</div>
<!-- /Talents -->
