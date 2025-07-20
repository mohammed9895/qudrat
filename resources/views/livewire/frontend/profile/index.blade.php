@php use Carbon\Carbon; @endphp
<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-[160px] pb-28">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $profile->fullname }}</h2>
                </div>
                <div class="w-6/12">
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
                        <div class="bg-brand-blue px-4 py-2 rounded-full absolute top-[20px] right-[20px]">
                            <div class="flex items-center gap-1">
                                    <span>
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.1809 7.67695L12.3621 10.1369L13.2065 13.7994C13.2512 13.9909 13.2384 14.1913 13.1698 14.3756C13.1013 14.5598 12.9799 14.7198 12.8209 14.8354C12.6619 14.9511 12.4723 15.0173 12.2759 15.0258C12.0795 15.0343 11.8849 14.9847 11.7165 14.8832L8.52212 12.9457L5.33462 14.8832C5.16623 14.9847 4.97166 15.0343 4.77523 15.0258C4.57881 15.0173 4.38924 14.9511 4.23024 14.8354C4.07125 14.7198 3.94986 14.5598 3.88128 14.3756C3.81269 14.1913 3.79994 13.9909 3.84462 13.7994L4.68775 10.1407L1.86837 7.67695C1.71925 7.54834 1.61142 7.37856 1.55841 7.18891C1.50539 6.99926 1.50955 6.79818 1.57036 6.61089C1.63116 6.42359 1.74592 6.25842 1.90022 6.13608C2.05453 6.01374 2.24152 5.93969 2.43775 5.9232L6.154 5.60132L7.60462 2.14132C7.68038 1.95977 7.80815 1.80469 7.97186 1.69561C8.13558 1.58653 8.3279 1.52832 8.52462 1.52832C8.72135 1.52832 8.91367 1.58653 9.07738 1.69561C9.24109 1.80469 9.36887 1.95977 9.44462 2.14132L10.8996 5.60132L14.6146 5.9232C14.8109 5.93969 14.9978 6.01374 15.1521 6.13608C15.3065 6.25842 15.4212 6.42359 15.482 6.61089C15.5428 6.79818 15.547 6.99926 15.494 7.18891C15.4409 7.37856 15.3331 7.54834 15.184 7.67695H15.1809Z"
                                                fill="#F4AA1A"></path>
                                        </svg>
                                    </span>
                                <p class="text-white text-sm">
                                    <span class="font-semibold">{{ $profile->rating() }}</span>
                                    ({{ $profile->ratings->count() }})
                                </p>
                            </div>
                        </div>
                        <img src="{{ $profile->getThumbnailImage() }}" width="120" height="120" alt="image"
                             class="mb-5 rounded-full border-2">
                        <h4 class="text-xl font-medium mb-1">{{ $profile->fullname }}</h4>
                        <p class="text-sm mb-5">{{ $profile->position }}</p>
                        <ul class="flex flex-col gap-3 mb-8">
                            @if (($profile->show_location || auth()->id() == $profile->user_id) && isset($profile->address))
                                <li class="flex items-center gap-2">
                                    <span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.5 8.33301C17.5 14.1663 10 19.1663 10 19.1663C10 19.1663 2.5 14.1663 2.5 8.33301C2.5 6.34388 3.29018 4.43623 4.6967 3.02971C6.10322 1.62318 8.01088 0.833008 10 0.833008C11.9891 0.833008 13.8968 1.62318 15.3033 3.02971C16.7098 4.43623 17.5 6.34388 17.5 8.33301Z"
                                                stroke="#344054" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M10 10.833C11.3807 10.833 12.5 9.71372 12.5 8.33301C12.5 6.9523 11.3807 5.83301 10 5.83301C8.61929 5.83301 7.5 6.9523 7.5 8.33301C7.5 9.71372 8.61929 10.833 10 10.833Z"
                                                stroke="#344054" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <p>{{ $profile->address }}</p>
                                </li>
                            @endif
                            @if (($profile->show_email || auth()->id() == $profile->user_id) && isset($profile->email))
                                <li class="flex items-center gap-2">
                                        <span>
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.33268 3.33301H16.666C17.5827 3.33301 18.3327 4.08301 18.3327 4.99967V14.9997C18.3327 15.9163 17.5827 16.6663 16.666 16.6663H3.33268C2.41602 16.6663 1.66602 15.9163 1.66602 14.9997V4.99967C1.66602 4.08301 2.41602 3.33301 3.33268 3.33301Z"
                                                    stroke="#344054" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path d="M18.3346 5L10.0013 10.8333L1.66797 5" stroke="#344054"
                                                      stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    <p><a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a></p>
                                </li>
                            @endif
                            @if (($profile->show_phone || auth()->id() == $profile->user_id) && isset($profile->phone))
                                <li class="flex items-center gap-2">
                                        <span>
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.3332 14.1004V16.6004C18.3341 16.8325 18.2866 17.0622 18.1936 17.2749C18.1006 17.4875 17.9643 17.6784 17.7933 17.8353C17.6222 17.9922 17.4203 18.1116 17.2005 18.186C16.9806 18.2603 16.7477 18.288 16.5165 18.2671C13.9522 17.9884 11.489 17.1122 9.32486 15.7087C7.31139 14.4293 5.60431 12.7222 4.32486 10.7087C2.91651 8.53474 2.04007 6.05957 1.76653 3.48374C1.7457 3.2533 1.77309 3.02104 1.84695 2.80176C1.9208 2.58248 2.03951 2.38098 2.1955 2.21009C2.3515 2.0392 2.54137 1.90266 2.75302 1.80917C2.96468 1.71569 3.19348 1.66729 3.42486 1.66707H5.92486C6.32928 1.66309 6.72136 1.80631 7.028 2.07002C7.33464 2.33373 7.53493 2.69995 7.59153 3.10041C7.69705 3.90046 7.89274 4.68601 8.17486 5.44207C8.28698 5.74034 8.31125 6.0645 8.24478 6.37614C8.17832 6.68778 8.02392 6.97383 7.79986 7.20041L6.74153 8.25874C7.92783 10.345 9.65524 12.0724 11.7415 13.2587L12.7999 12.2004C13.0264 11.9764 13.3125 11.8219 13.6241 11.7555C13.9358 11.689 14.2599 11.7133 14.5582 11.8254C15.3143 12.1075 16.0998 12.3032 16.8999 12.4087C17.3047 12.4658 17.6744 12.6697 17.9386 12.9817C18.2029 13.2936 18.3433 13.6917 18.3332 14.1004Z"
                                                    stroke="#344054" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    <p><a href="tel:{{ $profile->phone }}">{{ $profile->phone }}</a></p>
                                </li>
                            @endif
                        </ul>
                        @if (auth()->check() && $profile->can_send_message && auth()->id() != $profile->user_id)
                            <a wire:click="send_message" wire:ignore
                               class="px-8 py-3 mb-3 cursor-pointer rounded-full text-head-color font-medium bg-gray-200 text-gray-500 inline-flex items-center gap-2 w-full justify-center">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                               stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                                    </svg>
                                    </span>
                                {{ __('general.send-message') }}
                            </a>
                        @endif
                        <a
                            wire:click="download"
                            class="px-8 py-3 cursor-pointer rounded-full text-head-color font-medium bg-brand-blue text-white inline-flex items-center gap-2 w-full justify-center">
    <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
               xmlns="http://www.w3.org/2000/svg">
        <path
            d="M3.09502 10C3.03241 10.457 3 10.9245 3 11.4C3 16.7019 7.02944 21 12 21C16.9706 21 21 16.7019 21 11.4C21 10.9245 20.9676 10.457 20.905 10"
            stroke="white" stroke-width="2" stroke-linecap="round"/>
        <path
            d="M12 13L12 3M12 13C11.2998 13 9.99153 11.0057 9.5 10.5M12 13C12.7002 13 14.0085 11.0057 14.5 10.5"
            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span>
                            {{ __('general.download-cv') }}
                        </a>
                        <div class="bg-primary-3 p-5 rounded-xl mt-8">
                            <div class="flex items-center justify-center gap-4">
                                <div class="w-6/12 text-center">
                                    <h5 class="text-4xl font-semibold mb-1">{{ $profile->views->count() }}</h5>
                                    <p>{{ __('general.profile-views') }}</p>
                                </div>
                                <div class="w-6/12 text-center">
                                    <h5 class="text-4xl font-semibold mb-1">{{ $profile->works()->count() }}</h5>
                                    <p>{{ __('general.total-projects') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($profile->skills()->count() > 0)
                        <div class="bg-white p-6 rounded-xl mt-5">
                            <h6 class="text-lg font-semibold mb-3"><p>{{ __('general.skills') }}</p></h6>
                            <div class="flex items-center gap-3 flex-wrap">
                                @foreach($profile->skills()->get() as $skill)
                                    <a href="{{ route('social-window.index') }}"
                                       class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $skill->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($profile->languages()->count() > 0)
                        <div class="bg-white p-6 rounded-xl mt-5">
                            <h6 class="text-lg font-semibold mb-3">{{ __('general.languages') }}</h6>
                            <div class="flex items-center gap-3 flex-wrap">
                                @foreach($profile->languages()->get() as $language)
                                    <a href="{{ route('social-window.index') }}"
                                       class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $language->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($profile->tools()->count() > 0)
                        <div class="bg-white p-6 rounded-xl mt-5">
                            <h6 class="text-lg font-semibold mb-3">{{ __('general.tools') }}</h6>
                            <div class="flex items-center gap-3 flex-wrap">
                                @foreach($profile->tools()->get() as $tool)
                                    <a href="{{ route('social-window.index') }}"
                                       class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $tool->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($profile->interests()->count() > 0)
                        <div class="bg-white p-6 rounded-xl mt-5">
                            <h6 class="text-lg font-semibold mb-3">{{ __('general.interest') }}</h6>
                            <div class="flex items-center gap-3 flex-wrap">
                                @foreach($profile->interests()->get() as $interest)
                                    <a href="{{ route('social-window.index') }}"
                                       class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $interest->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="bg-white p-6 rounded-xl mt-5">
                        <h6 class="text-lg font-semibold mb-3">{{ __('general.social') }}</h6>
                        <div class="flex items-center gap-3 flex-wrap">
                            @if($profile->website)
                                <a href="{{ $profile->website }}"
                                   class="px-8 py-3 mt-2 rounded-full text-white font-medium bg-brand-blue inline-flex items-center gap-2 w-full justify-center">
                                    <span><x-hugeicons-global class="size-6"/></span>
                                    {{ __('general.view-website') }}
                                </a>
                            @endif
                            @if ($profile->show_social_links || auth()->id() == $profile->user_id)
                                <div class="flex justify-start items-center space-x-2">
                                    @if($profile->social_facebook)
                                        <a href="{{ $profile->social_facebook }}"
                                           class="w-10 h-10 rounded-full text-[#1d71b8] font-medium border-2 border-brand-blue inline-flex items-center justify-center hover:bg-brand-blue hover:text-white">
                                            <span><x-fab-facebook-f class="size-5"/></span>
                                        </a>
                                    @endif
                                    @if($profile->social_instagram)
                                        <a href="{{ $profile->social_instagram }}"
                                           class="w-10 h-10 rounded-full text-[#1d71b8] font-medium border-2 border-brand-blue inline-flex items-center justify-center hover:bg-brand-blue hover:text-white">
                                            <span><x-fab-instagram class="size-5"/></span>
                                        </a>
                                    @endif
                                    @if($profile->social_x)
                                        <a href="{{ $profile->social_x }}"
                                           class="w-10 h-10 rounded-full text-[#1d71b8] font-medium border-2 border-brand-blue inline-flex items-center justify-center hover:bg-brand-blue hover:text-white">
                                            <span><x-fab-x-twitter class="size-5"/></span>
                                        </a>
                                    @endif
                                    @if($profile->social_linkedin)
                                        <a href="{{ $profile->social_instagram }}"
                                           class="w-10 h-10 rounded-full text-[#1d71b8] font-medium border-2 border-brand-blue inline-flex items-center justify-center hover:bg-brand-blue hover:text-white">
                                            <span><x-fab-linkedin-in class="size-5"/></span>
                                        </a>
                                    @endif
                                    @if($profile->social_pinterest)
                                        <a href="{{ $profile->social_pinterest }}"
                                           class="w-10 h-10 rounded-full text-[#1d71b8] font-medium border-2 border-brand-blue inline-flex items-center justify-center hover:bg-brand-blue hover:text-white">
                                            <span><x-fab-pinterest class="size-5"/></span>
                                        </a>
                                    @endif
                                    @if($profile->social_stackoverflow)
                                        <a href="{{ $profile->social_stackoverflow }}"
                                           class="w-10 h-10 rounded-full text-[#1d71b8] font-medium border-2 border-brand-blue inline-flex items-center justify-center hover:bg-brand-blue hover:text-white">
                                            <span><x-fab-stack-overflow class="size-5"/></span>
                                        </a>
                                    @endif
                                    @if($profile->social_whatsapp)
                                        <a href="https://wa.me/{{ $profile->social_whatsapp }}"
                                           class="w-10 h-10 rounded-full text-[#1d71b8] font-medium border-2 border-brand-blue inline-flex items-center justify-center hover:bg-brand-blue hover:text-white">
                                            <span><x-fab-whatsapp class="size-5"/></span>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-span-full xl:col-span-9">
                    <div class="bg-white p-7 rounded-2xl">
                        <h4 class="text-[28px] font-semibold mb-3">{{ __('general.about-me') }}</h4>
                        {!! $profile->bio !!}
                    </div>
                    @if($profile->video)
                        <div class="inline-block relative rounded-2xl overflow-hidden w-full mt-7">
                            <video controls>
                                <source src="/uploads/{{ $profile->video }}">
                            </video>
                        </div>
                    @endif
                    @if($profile->educations()->count() > 0)
                        <div class="mt-7">
                            <h4 class="text-[28px] font-semibold mb-3">{{ __('general.educational-background') }}</h4>
                            <div class="grid grid-cols-12 gap-4">
                                @foreach($profile->educations as $education)
                                    <div class="col-span-full lg:col-span-4">
                                        <div class="bg-white p-7 rounded-xl h-full">
                                        <span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19 10C16.995 9.36815 14.5882 9 12 9C9.41179 9 7.00499 9.36815 5 10V13.5C7.00499 12.8682 9.41179 12.5 12 12.5C14.5882 12.5 16.995 12.8682 19 13.5V10Z"
                                                    stroke="#141B34" stroke-width="1.5" stroke-linejoin="round"/>
                                                <path
                                                    d="M19 11V14.2611C19.1795 15.4395 19.8462 18.0707 22 20.091C21.2821 21.2694 18.8769 23.1213 15 21.1011"
                                                    stroke="#141B34" stroke-width="1.5" stroke-linejoin="round"/>
                                                <path
                                                    d="M5 11V14.2611C4.82051 15.4395 4.15385 18.0707 2 20.091C2.71795 21.2694 5.12308 23.1213 9 21.1011"
                                                    stroke="#141B34" stroke-width="1.5" stroke-linejoin="round"/>
                                                <path
                                                    d="M16.5 16V17.3488C16.5 18.7695 15.8365 20.086 14.7522 20.8169L13.8522 21.4236C12.7121 22.1921 11.2879 22.1921 10.1478 21.4236L9.24782 20.8169C8.16348 20.086 7.5 18.7695 7.5 17.3488V16"
                                                    stroke="#141B34" stroke-width="1.5" stroke-linecap="round"/>
                                                <path
                                                    d="M19 10L20.1257 9.4071C21.3888 8.57875 22.0203 8.16457 21.9995 7.57281C21.9787 6.98105 21.32 6.62104 20.0025 5.90101L15.2753 3.31756C13.6681 2.43919 12.8645 2 12 2C11.1355 2 10.3319 2.43919 8.72468 3.31756L3.99753 5.90101C2.68004 6.62104 2.02129 6.98105 2.0005 7.57281C1.9797 8.16457 2.61125 8.57875 3.87434 9.4071L5 10"
                                                    stroke="#141B34" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                        </span>                                                <h6
                                                class="text-lg font-semibold mt-4 mb-2">{{ $education->educationType->name ?? '' }}</h6>
                                            <p class="text-md font-bold">{{ $education->fieldOfStudy->name ?? '' }}
                                                - {{ $education->fieldOfStudyChild->name ?? '' }}</p>
                                            <p class="text-sm mt-2">{{ $education->school->name ?? '' }}</p>
                                            <p class="text-sm mt-2">
                                                @if($education->start_date && Carbon::parse($education->start_date)->isValid())
                                                    {{ Carbon::parse($education->start_date)->format('Y') }} -
                                                @endif
                                                @if($education->end_date && Carbon::parse($education->end_date)->isValid())
                                                    - {{ Carbon::parse($education->end_date)->format('Y') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($profile->experiences()->count() > 0)
                        <div class="mt-7">
                            <h4 class="text-[28px] font-semibold mb-3">{{ __('general.work-experience') }}</h4>
                            <div class="grid grid-cols-12 gap-4">
                                @foreach($profile->experiences as $experience)
                                    <div class="col-span-full lg:col-span-6">
                                        <div class="bg-white p-7 rounded-xl h-full">
                                        <span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.0616 3.87181C11.6763 3.7094 12.3237 3.7094 12.9384 3.87181L13.3216 2.42157C12.4557 2.19281 11.5443 2.19281 10.6784 2.42157L11.0616 3.87181ZM16.927 7.06315C16.927 4.88128 15.4419 2.98176 13.3216 2.42157L12.9384 3.87181C14.4126 4.26128 15.427 5.57456 15.427 7.06315H16.927ZM8.57297 7.06315C8.57297 5.57455 9.58742 4.26128 11.0616 3.87181L10.6784 2.42157C8.55808 2.98176 7.07297 4.88127 7.07297 7.06315H8.57297ZM7.8414 7.50384L8.91496 7.29685L8.63098 5.82397L7.55742 6.03096L7.8414 7.50384ZM15.085 7.29685L16.1586 7.50384L16.4426 6.03096L15.369 5.82397L15.085 7.29685ZM19.8058 10.816L19.8988 11.1419L21.3412 10.7303L21.2482 10.4044L19.8058 10.816ZM4.10118 11.1419L4.19418 10.816L2.75176 10.4044L2.65877 10.7303L4.10118 11.1419ZM4.10471 16.1972C3.63385 14.5472 3.63087 12.79 4.10118 11.1419L2.65877 10.7303C2.11113 12.6493 2.1152 14.6917 2.66229 16.6088L4.10471 16.1972ZM19.8988 11.1419C20.3691 12.79 20.3662 14.5472 19.8953 16.1972L21.3377 16.6088C21.8848 14.6917 21.8889 12.6493 21.3412 10.7303L19.8988 11.1419ZM15.8509 19.8822C13.3077 20.3726 10.6923 20.3726 8.1491 19.8822L7.86512 21.3551C10.5959 21.8816 13.4041 21.8816 16.1349 21.3551L15.8509 19.8822ZM8.91496 7.29685C10.9524 6.90402 13.0477 6.90402 15.085 7.29685L15.369 5.82397C13.144 5.39498 10.856 5.39498 8.63098 5.82397L8.91496 7.29685ZM8.1491 19.8822C6.20493 19.5074 4.63939 18.0709 4.10471 16.1972L2.66229 16.6088C3.3533 19.0303 5.36966 20.874 7.86512 21.3551L8.1491 19.8822ZM16.1349 21.3551C18.6303 20.874 20.6467 19.0303 21.3377 16.6088L19.8953 16.1972C19.3606 18.0708 17.7951 19.5074 15.8509 19.8822L16.1349 21.3551ZM16.1586 7.50384C17.9164 7.84275 19.3239 9.12718 19.8058 10.816L21.2482 10.4044C20.6087 8.16326 18.747 6.47528 16.4426 6.03096L16.1586 7.50384ZM7.55742 6.03096C5.25297 6.47528 3.39132 8.16325 2.75176 10.4044L4.19418 10.816C4.67613 9.12717 6.08361 7.84275 7.8414 7.50384L7.55742 6.03096ZM3.38575 11.7917C8.93989 13.8462 15.0601 13.8462 20.6143 11.7917L20.0939 10.3849C14.8755 12.3151 9.12447 12.3151 3.90612 10.3849L3.38575 11.7917Z"
                                                    fill="#363853"/>
                                                <path d="M8 10.5V14" stroke="#363853" stroke-width="1.5"
                                                      stroke-linecap="round"/>
                                                <path d="M16 10.5V14" stroke="#363853" stroke-width="1.5"
                                                      stroke-linecap="round"/>
                                            </svg>
                                        </span>
                                            <h6 class="text-lg font-semibold mt-4 mb-2">{{ $experience->position }}</h6>
                                            <p class="text-md mt-2">{{ $experience->company }}</p>
                                            <p class="text-sm mt-2">{{ Carbon::parse($experience->start_date)->format('Y') }}
                                                - {{ $experience->is_current ? __('general.present') : Carbon::parse($experience->end_date)->format('Y')}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($profile->certificates()->count() > 0)
                        <div class="mt-7">
                            <h4 class="text-[28px] font-semibold mb-3">{{ __('general.certification-list') }}</h4>
                            <div class="grid grid-cols-12 gap-4">
                                @foreach($profile->certificates as $certificate)
                                    <div class="col-span-full lg:col-span-4">
                                        <div class="bg-white p-7 rounded-xl h-full">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12"/>
                                              </svg>

                                        </span>
                                            <h6 class="text-lg font-semibold mt-4 mb-2">{{ $certificate->title }}</h6>
                                            <p class="text-md mt-2">{{ $certificate->organization }}</p>
                                            @if($certificate->certificate_file)
                                                <a href="/uploads/{{ $certificate->certificate_file }}"
                                                   class="text-primary-2 flex items-center space-x-2"
                                                   target="_blank">@svg('hugeicons-file-01', 'size-5 mr-1')View
                                                    Certificate</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($profile->courses()->count() > 0)
                        <div class="mt-7">
                            <h4 class="text-[28px] font-semibold mb-3">{{ __('general.courses.title') }}</h4>
                            <div class="grid grid-cols-12 gap-4">
                                @foreach($profile->courses as $course)
                                    <div class="col-span-full lg:col-span-4">
                                        <div class="bg-white p-7 rounded-xl h-full">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12"/>
                                              </svg>

                                        </span>
                                            <h6 class="text-lg font-semibold mt-4 mb-2">{{ $course->title }}</h6>
                                            <p class="text-md mt-2">{{ $course->organization }}</p>
                                            @if($course->course_file)
                                                <a href="/uploads/{{ $course->course_file }}"
                                                   class="text-primary-2 flex items-center space-x-2"
                                                   target="_blank">@svg('hugeicons-file-01', 'size-5 mr-1')View
                                                    Certificate</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($profile->achievements()->count() > 0)
                        <div class="mt-7">
                            <h4 class="text-[28px] font-semibold mb-3">{{ __('general.achievements.title') }}</h4>
                            <div class="grid grid-cols-12 gap-4">
                                @foreach($profile->achievements as $achievement)
                                    <div class="col-span-full lg:col-span-6">
                                        <div class="bg-white p-7 rounded-xl h-full">
                                        <span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M22.2391 4.93085C22.1969 4.8884 22.1467 4.85475 22.0914 4.83185C22.0361 4.80895 21.9768 4.79726 21.917 4.79745H19.7449C19.8757 3.85599 19.9408 2.90658 19.9399 1.95608C19.9399 1.83512 19.8918 1.71911 19.8063 1.63358C19.7207 1.54805 19.6047 1.5 19.4838 1.5H4.88926C4.7683 1.5 4.65229 1.54805 4.56676 1.63358C4.48123 1.71911 4.43318 1.83512 4.43318 1.95608C4.43243 2.90697 4.49777 3.85676 4.62872 4.79859H2.45608C2.33512 4.79859 2.21911 4.84664 2.13358 4.93217C2.04805 5.0177 2 5.13371 2 5.25467C2 6.75574 2.56155 8.21063 3.62421 9.46257C4.61504 10.6301 5.99753 11.5719 7.62744 12.1911C8.34976 13.0411 9.17127 13.6955 10.0675 14.1032C9.97796 16.8305 8.69182 18.8236 8.28192 19.392H7.90166C7.6295 19.392 7.36849 19.5001 7.17604 19.6925C6.9836 19.885 6.87548 20.146 6.87548 20.4181V21.7111C6.87548 21.9833 6.9836 22.2443 7.17604 22.4367C7.36849 22.6292 7.6295 22.7373 7.90166 22.7373H16.4725C16.7447 22.7373 17.0057 22.6292 17.1981 22.4367C17.3906 22.2443 17.4987 21.9833 17.4987 21.7111V20.4181C17.4987 20.146 17.3906 19.885 17.1981 19.6925C17.0057 19.5001 16.7447 19.392 16.4725 19.392H16.098C15.6858 18.7991 14.3996 16.745 14.3067 14.1026C15.2029 13.695 16.0244 13.0405 16.7467 12.1905C18.3766 11.5702 19.7591 10.629 20.75 9.462C21.8115 8.20778 22.373 6.75517 22.373 5.25467C22.3734 5.1945 22.3617 5.13487 22.3387 5.07927C22.3157 5.02367 22.2818 4.97321 22.2391 4.93085ZM2.93325 5.71075H4.77866C5.13497 7.59663 5.75467 9.30237 6.57675 10.7008C4.44401 9.51045 3.10998 7.70609 2.93325 5.71075ZM16.5865 20.4193V21.7123C16.5865 21.7425 16.5745 21.7715 16.5531 21.7929C16.5318 21.8143 16.5028 21.8263 16.4725 21.8263H7.90166C7.87142 21.8263 7.84242 21.8143 7.82104 21.7929C7.79965 21.7715 7.78764 21.7425 7.78764 21.7123V20.4181C7.78764 20.3879 7.79965 20.3589 7.82104 20.3375C7.84242 20.3161 7.87142 20.3041 7.90166 20.3041H16.4725C16.5028 20.3041 16.5318 20.3161 16.5531 20.3375C16.5745 20.3589 16.5865 20.3879 16.5865 20.4181V20.4193ZM9.3805 19.3931C10.3074 17.8903 10.8517 16.1832 10.9659 14.4213C11.7673 14.6277 12.608 14.6277 13.4094 14.4213C13.5525 16.6521 14.4356 18.4439 15.0102 19.3937L9.3805 19.3931ZM13.6802 13.378C12.7205 13.7563 11.6531 13.7563 10.6934 13.378C9.22372 12.8079 7.87943 11.3872 6.90855 9.37477C5.95762 7.40451 5.40976 4.94853 5.35104 2.41273H19.0231C18.9661 4.94853 18.4166 7.40451 17.4656 9.37477C16.4948 11.3866 15.151 12.8085 13.6802 13.378ZM17.7974 10.6985C18.6201 9.29838 19.2398 7.59378 19.5955 5.7079H21.4404C21.2636 7.70438 19.9302 9.50931 17.7974 10.7002V10.6985Z"
                                                    fill="black" stroke="black" stroke-width="0.5"/>
                                            </svg>
                                        </span>
                                            <h6 class="text-lg font-semibold mt-4 mb-2">{{ $achievement->title }}</h6>
                                            <p class="text-sm">{{ $achievement->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($profile->works()->count() > 0)
                        <div class="mt-7">
                            <h4 class="text-[28px] font-semibold mb-3">{{ __('general.works') }}</h4>
                            <div class="grid lg:grid-cols-3 gap-4">
                                @foreach($profile->works as $work)
                                    <div
                                        class="bg-white border-[3px] border-white rounded-xl p-3 relative hover:bg-white transition-all">
                                        <div class="w-full mb-4">
                                            <div class="rounded-md w-full h-36"
                                                 style="background: url('/uploads/{{ $work->cover }}'); background-size: cover; background-position: center center;"></div>
                                        </div>
                                        <h4 class="text-xl font-medium mb-2">{{ $work->title }}</h4>

                                        <div class="flex items-center justify-start space-x-2">
                                            <a href="{{ route('works.category', $work->workCategory) }}"
                                               class="text-sm mt- mb-4 inline-flex items-center justify-center">
                                                <x-hugeicons-sticky-note-02 class="size-5 mr-1 text-primary-1"/>
                                                <span>{{ $work->workCategory->name }}</span>
                                            </a>
                                            <div class="text-sm mt- mb-4 inline-flex items-center justify-center">
                                                <x-hugeicons-calendar-03 class="size-5 mr-1 text-primary-1"/>
                                                <span>{{ Carbon::parse($work->created_at)->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        @if($work->skills)
                                            <div class="flex items-center gap-1 flex-wrap mb-4">
                                                @foreach($work->skills as $skill)
                                                    <span
                                                        class="px-3 py-1 border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $skill->name }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                        <a href="{{ route('works.show', $work) }}"
                                           class="inline-block px-8 py-3 rounded-full border border-primary-1 text-head-color font-medium hover:bg-primary-1 hover:text-white">View
                                            Work</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="mt-7">
                        <h4 class="text-[28px] font-semibold mb-3">{{ __('general.reviews') }}</h4>
                        @if($profile->user_id != auth()->id() && auth()->check())
                            <div class="w-full mb-5">
                                <form wire:submit="rate">
                                    <!-- Rating -->
                                    <div class="flex flex-row-reverse justify-end items-center mb-3">
                                        <input id="hs-ratings-readonly-5" type="radio"
                                               class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                               name="hs-ratings-readonly" wire:model="rating" value="5">
                                        <label for="hs-ratings-readonly-5"
                                               class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none ">
                                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                 height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </label>
                                        <input id="hs-ratings-readonly-4" type="radio"
                                               class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                               name="hs-ratings-readonly" wire:model="rating" value="4">
                                        <label for="hs-ratings-readonly-4"
                                               class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none ">
                                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                 height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </label>
                                        <input id="hs-ratings-readonly-3" type="radio"
                                               class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                               name="hs-ratings-readonly" wire:model="rating" value="3">
                                        <label for="hs-ratings-readonly-3"
                                               class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none ">
                                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                 height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </label>
                                        <input id="hs-ratings-readonly-2" type="radio"
                                               class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                               name="hs-ratings-readonly" wire:model="rating" value="2">
                                        <label for="hs-ratings-readonly-2"
                                               class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none ">
                                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                 height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </label>
                                        <input id="hs-ratings-readonly-1" type="radio"
                                               class="peer -ms-5 size-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                                               name="hs-ratings-readonly" wire:model="rating" value="1">
                                        <label for="hs-ratings-readonly-1"
                                               class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none ">
                                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                 height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </label>
                                    </div>
                                    <!-- End Rating -->

                                    <div class="space-y-3">
                                        <textarea
                                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-[#3cc7bc] focus:ring-[#3cc7bc] disabled:opacity-50 disabled:pointer-events-none"
                                            rows="3" placeholder="{{ __('general.write-review') }}"
                                            wire:model="comment"></textarea>
                                    </div>

                                    <button class="bg-primary-1 text-white py-3 px-6 rounded-lg text-sm mt-2">
                                        {{ __('general.submit') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                        @if ($profile->show_ratings || auth()->id() == $profile->user_id)
                            @foreach($profile->ratings()->orderByDesc('created_at')->get() as $rating)
                                @if($loop->index == 0)
                                    <div class="py-4">
                                        @endif
                                        <div class="py-4 border-t">
                                            <div class="flex gap-4">
                                                <div class="shrink-0">
                                                    <img src="{{ $rating->user->profile->getThumbnailImage() }}"
                                                         alt="images"
                                                         class="size-16 rounded-full">
                                                </div>
                                                <div class="w-full">
                                                    <div
                                                        class="w-full flex items-center justify-between gap-3 flex-wrap mb-3">
                                                        <div>
                                                            <h6 class="text-[18px] font-semibold mb-0">{{ $rating->user->profile->fullname }}</h6>
                                                            <p class="text-primary-2 text-sm">{{ Carbon::parse($rating->created_at)->format('Y-m-d h:i') }}</p>
                                                        </div>
                                                        <div class="flex items-center gap-[2px] mb-3">
                                                        <span
                                                            class="{{ $rating->rating >= 1 ? 'text-warning' : 'text-secondary-1' }}"><i
                                                                class="las la-star"></i></span>
                                                            <span
                                                                class="{{ $rating->rating >= 2 ? 'text-warning' : 'text-secondary-1' }}"><i
                                                                    class="las la-star"></i></span>
                                                            <span
                                                                class="{{ $rating->rating >= 3 ? 'text-warning' : 'text-secondary-1' }}"><i
                                                                    class="las la-star"></i></span>
                                                            <span
                                                                class="{{ $rating->rating >= 4 ? 'text-warning' : 'text-secondary-1' }}"><i
                                                                    class="las la-star"></i></span>
                                                            <span
                                                                class="{{ $rating->rating >= 5 ? 'text-warning' : 'text-secondary-1' }}"><i
                                                                    class="las la-star"></i></span>
                                                        </div>
                                                    </div>
                                                    <p>{{ $rating->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Sidebar & Content -->
</div>
