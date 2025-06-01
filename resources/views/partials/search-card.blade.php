@if(in_array($type, ['profiles', 'experts', 'researchers', 'innovators']))

    <div class="bg-transparent border-[3px] border-white rounded-xl p-7 relative bg-white transition-all">
        <div class="bg-primary-2 px-4 py-2 rounded-full absolute top-[-20px] right-[25px]">
            <div class="flex items-center justify-center gap-1">
                                            <span>
                                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.1809 7.67695L12.3621 10.1369L13.2065 13.7994C13.2512 13.9909 13.2384 14.1913 13.1698 14.3756C13.1013 14.5598 12.9799 14.7198 12.8209 14.8354C12.6619 14.9511 12.4723 15.0173 12.2759 15.0258C12.0795 15.0343 11.8849 14.9847 11.7165 14.8832L8.52212 12.9457L5.33462 14.8832C5.16623 14.9847 4.97166 15.0343 4.77523 15.0258C4.57881 15.0173 4.38924 14.9511 4.23024 14.8354C4.07125 14.7198 3.94986 14.5598 3.88128 14.3756C3.81269 14.1913 3.79994 13.9909 3.84462 13.7994L4.68775 10.1407L1.86837 7.67695C1.71925 7.54834 1.61142 7.37856 1.55841 7.18891C1.50539 6.99926 1.50955 6.79818 1.57036 6.61089C1.63116 6.42359 1.74592 6.25842 1.90022 6.13608C2.05453 6.01374 2.24152 5.93969 2.43775 5.9232L6.154 5.60132L7.60462 2.14132C7.68038 1.95977 7.80815 1.80469 7.97186 1.69561C8.13558 1.58653 8.3279 1.52832 8.52462 1.52832C8.72135 1.52832 8.91367 1.58653 9.07738 1.69561C9.24109 1.80469 9.36887 1.95977 9.44462 2.14132L10.8996 5.60132L14.6146 5.9232C14.8109 5.93969 14.9978 6.01374 15.1521 6.13608C15.3065 6.25842 15.4212 6.42359 15.482 6.61089C15.5428 6.79818 15.547 6.99926 15.494 7.18891C15.4409 7.37856 15.3331 7.54834 15.184 7.67695H15.1809Z"
                                                        fill="#F4AA1A"/>
                                                </svg>
                                            </span>
                <p class="text-white text-sm">
                    <span class="font-semibold">{{ $item->rating() }}</span>
                    ({{ $item->ratings->count() }})
                </p>
            </div>
        </div>
        <div class="flex flex-col justify-center items-center">
            <div class="relative inline-block mb-4">
                <div class="size-24 rounded-full"
                     style="background: url({{$item->getThumbnailImage()}}); background-size: cover; background-position: center center;"></div>
                <div
                    class="bg-success w-3 h-3 rounded-full border-2 border-white absolute end-[10px] bottom-[5px]"></div>
            </div>
            <h4 class="text-xl font-medium mb-2">{{ $item->fullname }}</h4>
            <p class="text-sm mb-4">{{ $item->position }}</p>
            @if($item->skills()->count() > 0)
                <div class="flex items-center gap-1 flex-wrap mb-4">
                    @foreach($item->skills()->get() as $skill)
                        <span
                            class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $skill }}</span>
                    @endforeach
                </div>
            @endif
            {{--                                    <p class="mb-6">{{ substr($profile->bio, 0 ,100) }}</p>--}}
            <a href="{{ route('profile.index', $item) }}"
               class="inline-block px-8 py-3 rounded-full border border-primary-1 text-head-color font-medium hover:bg-primary-1 hover:text-white">{{ __('general.view-profile') }}</a>

        </div>
    </div>

@elseif($type === 'jobs')
    {{-- Job-style card --}}
    <div class="col-span-full lg:col-span-6">
        <div class="bg-white px-6 py-8 rounded-2xl">
            <div class="flex items-center gap-3 mb-6">
                <div class="shrink-0">
                    <img src="/storage/{{ $item->entity->logo  }}" width="100" alt="image"
                         class="">
                </div>
                <div>
                    <h6 class="text-[18px] font-semibold">{{ $item->entity->name }}</h6>
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
                        <p class="text-sm">{{ $item->province->name }}</p>
                    </div>
                </div>
            </div>
            <h5 class="text-xl font-bold mb-1">{{ $item->title }}</h5>
            <p class="text-sm mb-4">{{ $item->employmentType->name }}
                - {{ $item->jobDepartment->name }}</p>
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
                        OMR{{ $item->salary }}</p>
                </div>
                <a href="{{ $item->apply_link }}" target="_blank"
                   class="px-6 py-2 rounded-full border border-primary-2 text-sm text-head-color font-medium hover:bg-primary-2 hover:text-white">{{ __('general.apply-now') }}</a>
            </div>
        </div>
    </div>

@elseif($type === 'works')
    {{-- Work-style card --}}
    <div class="bg-white border-[3px] border-white rounded-xl p-3 relative hover:bg-white transition-all">
        <div class="w-full mb-4">
            <div class="rounded-md w-full h-36"
                 style="background: url('{{ $item->getThumbnailImage() }}'); background-size: cover; background-position: center center;"></div>
        </div>
        <h4 class="text-xl font-medium mb-2">{{ $item->title }}</h4>

        <div class="flex items-center justify-start space-x-2">
            <a href="{{ route('works.category', $item->workCategory) }}"
               class="text-sm mt- mb-4 inline-flex items-center justify-center">
                <x-hugeicons-sticky-note-02 class="size-5 mr-1 text-primary-1"/>
                <span>{{ $item->workCategory->name }}</span>
            </a>
            <div class="text-sm mt- mb-4 inline-flex items-center justify-center">
                <x-hugeicons-calendar-03 class="size-5 mr-1 text-primary-1"/>
                <span>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
            </div>
        </div>
        @if($item->skills)
            <div class="flex items-center gap-1 flex-wrap mb-4">
                @foreach($item->skills as $skill)
                    <a href="{{ route('works.skill', $skill) }}"
                       class="px-3 py-1 inline-flex border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $skill->name }}</a>
                @endforeach
            </div>
        @endif
        <a href="{{ route('works.show', $item) }}"
           class="inline-block px-8 py-3 rounded-full border border-primary-1 text-head-color font-medium hover:bg-primary-1 hover:text-white">{{ __('general.view-work') }}</a>
    </div>
@endif
