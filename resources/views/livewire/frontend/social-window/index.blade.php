<div>
    <!-- Banner -->
    <div class="bg-primary-3 pt-24 md:pt-10 pb-5">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <div class="flex items-center gap-3 mb-3">
                        <a href="" class="text-head-color text-sm">Home</a>
                        <span class="text-gray-3 text-sm">/</span>
                        <a href="" class="text-head-color text-sm">Pages</a>
                        <span class="text-gray-3 text-sm">/</span>
                        <span class="text-b-color text-sm">Social Activity</span>
                    </div>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">Social Window</h2>
                </div>
                <div class="w-6/12">
                    <div class="text-end">
                        <img src="assets/images/banner_3.png" alt="images" class="hidden md:block">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Tab & Siderbar -->
    <div class="py-24">
        <div class="container">
            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-full md:col-span-4 xl:col-span-3">
                    <div class="bg-white p-6 rounded-xl">
                        <h6 class="text-lg font-semibold mb-3">Search</h6>
                        <div class="">
                            <input type="text" wire:model.live.debounce.150ms="search" class="w-full border border-gray-1 rounded-xl p-3 focus:border-[#3cc7bc] focus:ring-[#3cc7bc]" placeholder="Job title, key words or company">
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl mt-5">
                        <h6 class="text-lg font-semibold mb-3">Province</h6>
                        <div class="">
                            <select wire:model.live="province" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                                <option value="">All</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h6 class="text-lg font-semibold mb-3 mt-3">State</h6>
                        <div class="">
                            <select wire:model.live="state" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                                <option value="">All</option>
                                @foreach($this->states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h6 class="text-lg font-semibold mt-3 mb-3">Category</h6>
                        <div class="">
                            <select wire:model.live="category" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                                <option value="">All</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h6 class="text-lg font-semibold mt-3 mb-3">Gender</h6>
                        <div class="">
                            <select wire:model.live="gender" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                                <option value="">All</option>
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                        </div>
                        <h6 class="text-lg font-semibold mt-3 mb-3">Education Level</h6>
                        <div class="">
                            <select wire:model.live="educationType" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                                <option value="">All</option>
                               @foreach($educationTypes as $educationType)
                                    <option value="{{ $educationType->id }}">{{ $educationType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h6 class="text-lg font-semibold mt-3 mb-3">Experience Level</h6>
                        <div class="">
                            <select wire:model.live="experienceLevel" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                                <option value="">All</option>
                                @foreach($experiences_levels as $experience_level)
                                    <option value="{{ $experience_level->id }}">{{ $experience_level->name }}</option>
                                @endforeach
                            </select>
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
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        @foreach($this->profiles as $talent)
                                <div class="bg-transparent border-[3px] border-white rounded-xl p-7 relative bg-white transition-all">
                                    <div class="bg-primary-2 px-4 py-2 rounded-full absolute top-[-20px] right-[25px]">
                                        <div class="flex items-center justify-center gap-1">
                                            <span>
                                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.1809 7.67695L12.3621 10.1369L13.2065 13.7994C13.2512 13.9909 13.2384 14.1913 13.1698 14.3756C13.1013 14.5598 12.9799 14.7198 12.8209 14.8354C12.6619 14.9511 12.4723 15.0173 12.2759 15.0258C12.0795 15.0343 11.8849 14.9847 11.7165 14.8832L8.52212 12.9457L5.33462 14.8832C5.16623 14.9847 4.97166 15.0343 4.77523 15.0258C4.57881 15.0173 4.38924 14.9511 4.23024 14.8354C4.07125 14.7198 3.94986 14.5598 3.88128 14.3756C3.81269 14.1913 3.79994 13.9909 3.84462 13.7994L4.68775 10.1407L1.86837 7.67695C1.71925 7.54834 1.61142 7.37856 1.55841 7.18891C1.50539 6.99926 1.50955 6.79818 1.57036 6.61089C1.63116 6.42359 1.74592 6.25842 1.90022 6.13608C2.05453 6.01374 2.24152 5.93969 2.43775 5.9232L6.154 5.60132L7.60462 2.14132C7.68038 1.95977 7.80815 1.80469 7.97186 1.69561C8.13558 1.58653 8.3279 1.52832 8.52462 1.52832C8.72135 1.52832 8.91367 1.58653 9.07738 1.69561C9.24109 1.80469 9.36887 1.95977 9.44462 2.14132L10.8996 5.60132L14.6146 5.9232C14.8109 5.93969 14.9978 6.01374 15.1521 6.13608C15.3065 6.25842 15.4212 6.42359 15.482 6.61089C15.5428 6.79818 15.547 6.99926 15.494 7.18891C15.4409 7.37856 15.3331 7.54834 15.184 7.67695H15.1809Z" fill="#F4AA1A"/>
                                                </svg>
                                            </span>
                                            <p class="text-white text-sm">
                                                <span class="font-semibold">{{ $talent->rating() }}</span> ({{ $talent->ratings->count() }})
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-center items-center">
                                        <div class="relative inline-block mb-4">
                                            <div class="size-24 rounded-full" style="background: url({{$talent->getThumbnailImage()}}); background-size: cover; background-position: center center;"></div>
                                            <div class="bg-success w-3 h-3 rounded-full border-2 border-white absolute end-[10px] bottom-[5px]"></div>
                                        </div>
                                        <h4 class="text-xl font-medium mb-2">{{ $talent->fullname }}</h4>
                                        <p class="text-sm mb-4">{{ $talent->position }}</p>
                                        @if($talent->skills()->count() > 0)
                                            <div class="flex items-center gap-1 flex-wrap mb-4">
                                                @foreach($talent->skills as $skill)
                                                    <span class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $skill }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                        {{--                                    <p class="mb-6">{{ substr($talent->bio, 0 ,100) }}</p>--}}
                                        <a href="{{ route('profile.index', $talent) }}" class="inline-block px-8 py-3 rounded-full border border-primary-1 text-head-color font-medium hover:bg-primary-1 hover:text-white">View Profile</a>

                                    </div>
                                    </div>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $this->profiles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Tab & Siderbar -->
</div>
