<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-24 md:pt-12 pb-9">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.jobs') }}</h2>
                </div>
                <div class="w-6/12">
                    <div class="flex justify-end">
                        <img src="/assets/images/banner_5.png" alt="image" class="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Search -->
    <div class="relative z-10 mt-[-60px]">
        <div class="container">
            <div class="bg-white p-10 rounded-lg shadow-default">
                <h5 class="text-2xl mb-5">{{ __('general.job-page-title', ['job' => 13933]) }}</h5>
                <div class="flex items-center gap-5 flex-wrap 2xl:flex-nowrap">
                    <form action="" class="relative min-w-full 2xl:min-w-[415px]">
                        <input type="text" class="bg-white w-full px-5 py-4 border border-gray-1 rounded-lg"
                               wire:model.live="search" placeholder="{{ __('general.search-placeholder') }}">
                        <div class="flex items-center gap-2 absolute top-[4px] end-[6px]">
                            <button type="submit" class="bg-primary-2 rounded-lg text-white px-5 py-3">
                                {{ __('general.search') }}
                            </button>
                        </div>
                    </form>
                    <div class="grid grid-cols-12 gap-5 w-full">
                        <div class="col-span-full lg:col-span-4">
                            <div class="bg-white w-full ps-5 pe-4 py-4 border border-gray-1 rounded-lg relative">
                                    <span class="absolute start-[18px] top-[18px]">
                                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_149_3861)">
                                            <path
                                                d="M14.9681 7.88396C14.9681 11.8709 12.1977 14.1643 10.1216 16.3849C9.30756 17.2736 8.55965 18.2207 7.88396 19.2186C7.21066 18.2225 6.46464 17.2776 5.65198 16.3916C3.57584 14.1719 0.799805 11.8747 0.799805 7.88396C0.799805 6.00512 1.54617 4.20324 2.87471 2.87471C4.20324 1.54616 6.00512 0.799805 7.88396 0.799805C9.76277 0.799805 11.5647 1.54616 12.8932 2.87471C14.2217 4.20324 14.9681 6.00512 14.9681 7.88396Z"
                                                stroke="#2E3192" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M5.05078 7.88445C5.05078 8.63597 5.34933 9.35669 5.88074 9.88813C6.41216 10.4196 7.13291 10.7181 7.88445 10.7181C8.63599 10.7181 9.35671 10.4196 9.88815 9.88813C10.4196 9.35669 10.7181 8.63597 10.7181 7.88445C10.7181 7.13291 10.4196 6.41216 9.88815 5.88074C9.35671 5.34933 8.63599 5.05078 7.88445 5.05078C7.13291 5.05078 6.41216 5.34933 5.88074 5.88074C5.34933 6.41216 5.05078 7.13291 5.05078 7.88445Z"
                                                stroke="#2E3192" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_149_3861">
                                            <rect width="16" height="20" fill="white"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                <select class="bg-transparent hero_select !py-0 !px-8" wire:model.live="province">
                                    @foreach($provinces_list as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-span-full lg:col-span-4">
                            <div class="bg-white w-full ps-8 pe-4 py-4 border border-gray-1 rounded-lg relative">
                                    <span class="absolute start-[18px] top-[18px]">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_149_3873)">
                                            <path
                                                d="M12.1816 3.23047C12.1816 2.08167 11.2504 1.15039 10.1016 1.15039C8.95277 1.15039 8.02148 2.08167 8.02148 3.23047V16.7937C8.02148 17.9425 8.95277 18.8738 10.1016 18.8738C11.2504 18.8738 12.1816 17.9425 12.1816 16.7937V3.23047Z"
                                                stroke="#2E3192" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M5.26075 11.3721C5.26075 10.2233 4.32946 9.29199 3.18067 9.29199C2.03187 9.29199 1.10059 10.2233 1.10059 11.3721V16.7937C1.10059 17.9425 2.03187 18.8738 3.18067 18.8738C4.32946 18.8738 5.26075 17.9425 5.26075 16.7937V11.3721Z"
                                                stroke="#2E3192" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M19.1006 7.36328C19.1006 6.21449 18.1693 5.2832 17.0205 5.2832C15.8717 5.2832 14.9404 6.21449 14.9404 7.36328V16.7936C14.9404 17.9424 15.8717 18.8737 17.0205 18.8737C18.1693 18.8737 19.1006 17.9424 19.1006 16.7936V7.36328Z"
                                                stroke="#2E3192" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_149_3873">
                                            <rect width="20" height="19" fill="white" transform="translate(0 0.5)"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                <select class="bg-transparent hero_select !py-0 !px-8" wire:model.live="experience">
                                    @foreach($experiences_list as $experience)
                                        <option value="{{ $experience->id }}">{{ $experience->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-span-full lg:col-span-4">
                            <div class="bg-white w-full ps-8 pe-4 py-4 border border-gray-1 rounded-lg relative">
                                    <span class="absolute start-[18px] top-[18px]">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_149_3885)">
                                            <path
                                                d="M0.935547 7.29199C0.935547 6.18742 1.83098 5.29199 2.93555 5.29199H17.4404C18.545 5.29199 19.4404 6.18742 19.4404 7.29199V16.7758C19.4404 17.8803 18.545 18.7758 17.4404 18.7758H2.93555C1.83098 18.7758 0.935547 17.8803 0.935547 16.7758V7.29199Z"
                                                stroke="#2E3192" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M14.2338 5.29219C14.2338 4.21936 13.8076 3.19047 13.049 2.43186C12.2904 1.67326 11.2615 1.24707 10.1887 1.24707C9.11583 1.24707 8.08694 1.67326 7.32833 2.43186C6.56973 3.19047 6.14355 4.21936 6.14355 5.29219"
                                                stroke="#2E3192" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path d="M0.935547 10.6855H8.83962" stroke="#2E3192" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M11.5361 10.6855H19.4401" stroke="#2E3192" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <path
                                                d="M10.1882 12.7072C9.8306 12.7072 9.48763 12.5651 9.23476 12.3123C8.9819 12.0594 8.83984 11.7164 8.83984 11.3588V10.0105C8.83984 9.65287 8.9819 9.3099 9.23476 9.05703C9.48763 8.80417 9.8306 8.66211 10.1882 8.66211C10.5458 8.66211 10.8888 8.80417 11.1417 9.05703C11.3945 9.3099 11.5366 9.65287 11.5366 10.0105V11.3588C11.5366 11.7164 11.3945 12.0594 11.1417 12.3123C10.8888 12.5651 10.5458 12.7072 10.1882 12.7072Z"
                                                stroke="#2E3192" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_149_3885">
                                            <rect width="20" height="19" fill="white" transform="translate(0 0.5)"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                <select class="bg-transparent hero_select !py-0 !px-8" wire:model.live="department">
                                    @foreach($departments_list as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Search -->

    <!-- Sidebar & Post -->
    <div class="pt-12 pb-24">
        <div class="container">
            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-full xl:col-span-4">
                    <div class="bg-white p-6 rounded-xl">
                        <div class="pb-5 border-b">
                            <h6 class="text-lg font-semibold mb-3">{{ __('general.departments') }}</h6>
                            @foreach($departments_list as $department)
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" wire:model.live="departments" type="checkbox"
                                           value="{{ $department->id }}"
                                           class="peer w-4 h-4 text-primary-2 bg-white border-gray-300 rounded focus:ring-transparent focus:ring-2"
                                           checked>
                                    <label for="default-checkbox"
                                           class="ms-2 text-sm font-medium text-b-color peer-checked:text-primary-2 w-full flex items-center">
                                        {{ $department->name }}
                                        <span
                                            class="inline-block ms-auto">({{ $department->job_applications_count }})</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="pb-5 border-b mt-4">
                            <h6 class="text-lg font-semibold mb-3">{{ __('general.date-of-post') }}</h6>
                            <div class="flex items-center mb-4">
                                <input id="default-checkbox" type="checkbox" value=""
                                       class="peer w-4 h-4 text-primary-2 bg-white border-gray-300 rounded focus:ring-transparent focus:ring-2">
                                <label for="default-checkbox"
                                       class="ms-2 text-sm font-medium text-b-color peer-checked:text-primary-2">
                                    {{ __('general.past-24-hours') }}
                                </label>
                            </div>
                            <div class="flex items-center mb-4">
                                <input id="checked-checkbox" type="checkbox" value=""
                                       class="peer w-4 h-4 text-primary-2 bg-white border-gray-300 rounded focus:ring-primary-2 dark:focus:ring-transparent dark:ring-offset-gray-800 focus:ring-2">
                                <label for="checked-checkbox"
                                       class="ms-2 text-sm font-medium text-b-color  peer-checked:text-primary-2">
                                    {{ __('general.past-week') }}
                                </label>
                            </div>
                            <div class="flex items-center mb-4">
                                <input id="checked-checkbox" type="checkbox" value=""
                                       class="peer w-4 h-4 text-primary-2 bg-white border-gray-300 rounded focus:ring-primary-2 dark:focus:ring-transparent dark:ring-offset-gray-800 focus:ring-2">
                                <label for="checked-checkbox"
                                       class="ms-2 text-sm font-medium text-b-color  peer-checked:text-primary-2">
                                    {{ __('general.past-month') }}
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="checked-checkbox" type="checkbox" value=""
                                       class="peer w-4 h-4 text-primary-2 bg-white border-gray-300 rounded focus:ring-primary-2 dark:focus:ring-transparent dark:ring-offset-gray-800 focus:ring-2">
                                <label for="checked-checkbox"
                                       class="ms-2 text-sm font-medium text-b-color  peer-checked:text-primary-2">
                                    {{ __('general.any-time') }}
                                </label>
                            </div>
                        </div>
                        <div class="pb-5 border-b mt-4">
                            <h6 class="text-lg font-semibold mb-3">{{ __('general.province') }}</h6>
                            @foreach($provinces_list as $province)
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="{{ $province->id }}"
                                           wire:model.live="provinces"
                                           class="peer w-4 h-4 text-primary-2 bg-white border-gray-300 rounded focus:ring-transparent focus:ring-2">
                                    <label for="default-checkbox"
                                           class="ms-2 text-sm font-medium text-b-color peer-checked:text-primary-2 w-full flex items-center">
                                        {{ $province->name }}
                                        <span
                                            class="inline-block ms-auto">({{ $province->job_applications_count }})</span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <div class=" mt-4">
                            <h6 class="text-lg font-semibold mb-3">{{ __('general.experience-level') }}</h6>
                            @foreach($experiences_list as $experience)
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="{{ $experience->id }}"
                                           wire:model.live="experience"
                                           class="peer w-4 h-4 text-primary-2 bg-white border-gray-300 rounded focus:ring-transparent focus:ring-2">
                                    <label for="default-checkbox"
                                           class="ms-2 text-sm font-medium text-b-color peer-checked:text-primary-2">
                                        {{ $experience->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="col-span-full xl:col-span-8">
                    <div class="grid grid-cols-12 gap-4">
                        @foreach($this->jobs as $job)
                            <div class="col-span-full lg:col-span-6">
                                <div class="bg-white px-6 py-8 rounded-2xl">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="shrink-0">
                                            <img src="/storage/{{ $job->entity->logo  }}" width="100" alt="image"
                                                 class="">
                                        </div>
                                        <div>
                                            <h6 class="text-[18px] font-semibold">{{ $job->entity->name }}</h6>
                                            <div class="flex items-center gap-1">
                                                        <span>
                                                            <svg width="14" height="14" viewBox="0 0 20 20" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.5 8.33301C17.5 14.1663 10 19.1663 10 19.1663C10 19.1663 2.5 14.1663 2.5 8.33301C2.5 6.34388 3.29018 4.43623 4.6967 3.02971C6.10322 1.62318 8.01088 0.833008 10 0.833008C11.9891 0.833008 13.8968 1.62318 15.3033 3.02971C16.7098 4.43623 17.5 6.34388 17.5 8.33301Z"
                                                                    stroke="#344054" stroke-width="1.5"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path
                                                                    d="M10 10.833C11.3807 10.833 12.5 9.71372 12.5 8.33301C12.5 6.9523 11.3807 5.83301 10 5.83301C8.61929 5.83301 7.5 6.9523 7.5 8.33301C7.5 9.71372 8.61929 10.833 10 10.833Z"
                                                                    stroke="#344054" stroke-width="1.5"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                <p class="text-sm">{{ $job->province->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-xl font-bold mb-1">{{ $job->title }}</h5>
                                    <p class="text-sm mb-4">{{ $job->employmentType->name }}
                                        - {{ $job->jobDepartment->name }}</p>
                                    <p class="mb-5"></p>
                                    <div class="flex items-center justify-between gap-4 flex-wrap">
                                        <div class="flex items-center gap-3">
                                                    <span>
                                                        <svg width="24" height="20" viewBox="0 0 24 20" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M7.99665 6.14473C4.02266 6.14473 0 5.08937 0 3.07237C0 1.05537 4.02266 0 7.99665 0C11.9704 0 15.9932 1.0552 15.9932 3.07237C15.9932 5.08953 11.9703 6.14473 7.99665 6.14473ZM7.99665 1.10331C3.7887 1.10331 1.10331 2.26946 1.10331 3.07237C1.10331 3.87532 3.78881 5.04147 7.99665 5.04147C12.2044 5.04147 14.8899 3.87516 14.8899 3.07237C14.8899 2.26957 12.2045 1.10331 7.99665 1.10331Z"
                                                                  fill="#070F2C"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M7.99665 12.5887C4.02266 12.5887 0 11.5333 0 9.51648C0 9.21193 0.246871 8.96484 0.551686 8.96484C0.856229 8.96484 1.10332 9.21193 1.10332 9.51648C1.10332 10.3193 3.78882 11.4856 7.99665 11.4856C8.75437 11.4856 9.50123 11.4461 10.2166 11.3685C10.5216 11.3348 10.7917 11.5547 10.8246 11.8576C10.8573 12.1604 10.6386 12.4326 10.3358 12.4655C9.5809 12.5471 8.79386 12.5887 7.99665 12.5887Z"
                                                                  fill="#070F2C"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M7.99644 19.0327C5.95055 19.0327 4.01837 18.7605 2.55555 18.2663C0.443075 17.5528 -0.00020683 16.623 7.23798e-08 15.9687V3.08972C7.23798e-08 2.78496 0.246871 2.53809 0.551687 2.53809C0.856229 2.53809 1.10332 2.78496 1.10332 3.08972V15.9685C1.10332 16.2884 1.66147 16.7996 2.90864 17.2208C4.26073 17.6776 6.06757 17.9291 7.99648 17.9291C9.35205 17.9291 10.6712 17.8019 11.8115 17.5613C12.1096 17.4988 12.4024 17.6892 12.4652 17.9873C12.528 18.2855 12.3373 18.578 12.0392 18.641C10.8252 18.8975 9.42732 19.0327 7.99644 19.0327ZM15.4412 7.2925C15.1365 7.2925 14.8896 7.04563 14.8896 6.74082V3.08972C14.8896 2.78496 15.1365 2.53809 15.4412 2.53809C15.746 2.53809 15.9929 2.78496 15.9929 3.08972V6.74076C15.9929 7.04552 15.746 7.2925 15.4412 7.2925Z"
                                                                  fill="#070F2C"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M16.5814 16.3897C15.5071 16.3897 14.6328 15.5157 14.6328 14.4409C14.6328 14.1361 14.8797 13.8892 15.1844 13.8892C15.4893 13.8892 15.7361 14.1361 15.7361 14.4409C15.7361 14.9071 16.1152 15.2864 16.5814 15.2864C17.0476 15.2864 17.4269 14.9071 17.4269 14.4409C17.4269 13.8408 17.193 13.7567 16.4538 13.5807C15.7727 13.4185 14.6328 13.147 14.6328 11.647C14.6328 10.5724 15.5069 9.69824 16.5814 9.69824C17.656 9.69824 18.5302 10.5722 18.5302 11.647C18.5302 11.9518 18.2833 12.1987 17.9785 12.1987C17.6738 12.1987 17.4269 11.9518 17.4269 11.647C17.4269 11.1808 17.0476 10.8015 16.5814 10.8015C16.1152 10.8015 15.7361 11.1808 15.7361 11.647C15.7361 12.2471 15.97 12.3312 16.7092 12.5072C17.3903 12.6694 18.5302 12.9409 18.5302 14.4409C18.5302 15.5155 17.6562 16.3897 16.5814 16.3897Z"
                                                                  fill="#070F2C"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M16.5809 10.8017C16.2762 10.8017 16.0293 10.5548 16.0293 10.25V9.50774C16.0293 9.20293 16.2762 8.95605 16.5809 8.95605C16.8857 8.95605 17.1326 9.20293 17.1326 9.50774V10.25C17.1326 10.5547 16.8856 10.8017 16.5809 10.8017Z"
                                                                  fill="#070F2C"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M16.5809 17.1315C16.2762 17.1315 16.0293 16.8846 16.0293 16.5798V15.8378C16.0293 15.533 16.2762 15.2861 16.5809 15.2861C16.8857 15.2861 17.1326 15.533 17.1326 15.8378V16.5798C17.1326 16.8846 16.8856 17.1315 16.5809 17.1315Z"
                                                                  fill="#070F2C"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M16.5818 19.9995C12.7464 19.9995 9.62598 16.8791 9.62598 13.0437C9.62598 9.2082 12.7464 6.08789 16.5818 6.08789C20.4171 6.08789 23.5376 9.20837 23.5376 13.0437C23.5377 16.8791 20.4173 19.9995 16.5818 19.9995ZM16.5818 7.19083C13.3546 7.19083 10.7293 9.81633 10.7293 13.0435C10.7293 16.2707 13.3548 18.8961 16.5818 18.8961C19.8088 18.8961 22.4344 16.2706 22.4344 13.0435C22.4344 9.81632 19.8089 7.19083 16.5818 7.19083Z"
                                                                  fill="#070F2C"/>
                                                        </svg>
                                                    </span>
                                            <p class="text-head-color text-[18px] font-semibold">
                                                OMR{{ $job->salary }}</p>
                                        </div>
                                        <a href="{{ $job->apply_link }}" target="_blank"
                                           class="px-6 py-2 rounded-full border border-primary-2 text-sm text-head-color font-medium hover:bg-primary-2 hover:text-white">{{ __('general.apply-now') }}</a>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        <div class="col-span-full">
                            {{ $this->jobs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Sidebar & Post -->
</div>
