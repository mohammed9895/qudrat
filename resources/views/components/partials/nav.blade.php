<!-- Header -->
<nav x-data="{ open:false, dd:{social:false, intl:false, oman:false} }"
     class="nav_area w-full bg-white/90 backdrop-blur supports-[backdrop-filter]:bg-white/75 sticky top-0 z-50 border-b border-gray-100">
    <!-- Feedback Survey Bar -->
    <div dir="rtl" class="bg-brand-blue text-white text-sm py-3 px-4 text-center">
        <a href="/feedbacks" class="font-semibold hover:underline">
            📢 {{ __('general.navigation.feedback-survey') }}
            <span>{{ __('general.navigation.click-here') }}</span>
        </a>
    </div>

    <div class="mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex items-center justify-between py-3 gap-3">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 shrink-0">
                <img src="{{ asset('assets/images/logo.svg')}}" width="150" alt="Logo" class="h-10 w-auto">
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:block md:flex-1">
                <ul class="font-medium flex items-center justify-center gap-1 rtl:space-x-reverse">
                    <li>
                        <a href="/"
                           class="nav_link {{ request()->path() == '/' ? 'active' : '' }}">
                            {{ __('general.navigation.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.index') }}"
                           class="nav_link {{ request()->path() == 'about' ? 'active' : '' }}">
                            {{ __('general.navigation.about') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('digital-library.index') }}"
                           class="nav_link {{ request()->path() == 'digital-library' ? 'active' : '' }}">
                            {{ __('general.navigation.digital-library') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('future-skills.index') }}"
                           class="nav_link {{ request()->path() == 'future-skills' ? 'active' : '' }}">
                            {{ __('general.navigation.future-skills') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('media-center.index') }}"
                           class="nav_link {{ request()->path() == 'media-center' ? 'active' : '' }}">
                            {{ __('general.navigation.media-center') }}
                        </a>
                    </li>

                    <!-- Social Window (desktop) -->
                    <li class="relative">
                        <button @click="dd.social = !dd.social; dd.intl=false; dd.oman=false"
                                :class="dd.social ? 'text-brand-blue' : ''"
                                class="nav_link flex items-center gap-2">
                            {{ __('general.navigation.social-window') }}
                            <svg class="w-3.5 h-3.5" viewBox="0 0 10 6" fill="none" aria-hidden="true">
                                <path d="m1 1 4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div x-cloak x-show="dd.social" @click.outside="dd.social=false" x-transition
                             class="absolute mt-2 w-48 rounded-lg bg-white shadow border border-gray-100 py-2">
                            <a href="{{ route('social-window.index') }}" class="block px-4 py-2 hover:bg-gray-50">
                                {{ __('general.navigation.profiles') }}
                            </a>
                            <a href="{{ route('social-window.experts') }}" class="block px-4 py-2 hover:bg-gray-50">
                                {{ __('general.navigation.experts') }}
                            </a>
                            <a href="{{ route('jobs.index') }}" class="block px-4 py-2 hover:bg-gray-50">
                                {{ __('general.navigation.jobs') }}
                            </a>
                            <a href="{{ route('works.index') }}" class="block px-4 py-2 hover:bg-gray-50">
                                {{ __('general.navigation.works') }}
                            </a>
                        </div>
                    </li>

                    <!-- International Talents (desktop) -->
                    {{--                    <li class="relative">--}}
                    {{--                        <button @click="dd.intl = !dd.intl; dd.social=false; dd.oman=false"--}}
                    {{--                                :class="dd.intl ? 'text-brand-blue' : ''"--}}
                    {{--                                class="nav_link flex items-center gap-2">--}}
                    {{--                            {{ __('general.navigation.international-talents') }}--}}
                    {{--                            <svg class="w-3.5 h-3.5" viewBox="0 0 10 6" fill="none" aria-hidden="true">--}}
                    {{--                                <path d="m1 1 4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>--}}
                    {{--                            </svg>--}}
                    {{--                        </button>--}}
                    {{--                        <div x-cloak x-show="dd.intl" @click.outside="dd.intl=false" x-transition--}}
                    {{--                             class="absolute mt-2 w-56 rounded-lg bg-white shadow border border-gray-100 py-2">--}}
                    {{--                            <a href="{{ route('international-talents.index') }}" class="block px-4 py-2 hover:bg-gray-50">--}}
                    {{--                                {{ __('general.navigation.international-talents') }}--}}
                    {{--                            </a>--}}
                    {{--                            <a href="{{ route('international-talent-requests.index') }}" class="block px-4 py-2 hover:bg-gray-50">--}}
                    {{--                                {{ __('general.navigation.international-talent-request') }}--}}
                    {{--                            </a>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}

                    <!-- Oman Scientists (desktop) -->
                    <li class="relative">
                        <button @click="dd.oman = !dd.oman; dd.social=false; dd.intl=false"
                                :class="dd.oman ? 'text-brand-blue' : ''"
                                class="nav_link flex items-center gap-2">
                            {{ __('general.navigation.oman-scientists') }}
                            <svg class="w-3.5 h-3.5" viewBox="0 0 10 6" fill="none" aria-hidden="true">
                                <path d="m1 1 4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div x-cloak x-show="dd.oman" @click.outside="dd.oman=false" x-transition
                             class="absolute mt-2 w-56 rounded-lg bg-white shadow border border-gray-100 py-2">
                            <a href="{{ route('social-window.researchers') }}" class="block px-4 py-2 hover:bg-gray-50">
                                {{ __('general.navigation.researchers') }}
                            </a>
                            <a href="{{ route('social-window.innovators') }}" class="block px-4 py-2 hover:bg-gray-50">
                                {{ __('general.navigation.innovators') }}
                            </a>
                        </div>
                    </li>

                    <li>
                        <a href="{{ route('scale.index') }}"
                           class="nav_link {{ request()->path() == 'scale' ? 'active' : '' }}">
                            {{ __('general.navigation.scale') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}"
                           class="nav_link {{ request()->path() == 'contact' ? 'active' : '' }}">
                            {{ __('general.navigation.contact-us') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Right side: Auth / Lang + Mobile Hamburger -->
            <div class="flex items-center gap-2">
                @guest
                    <div class="hidden lg:flex items-center gap-2">
                        @if(session()->get('lang') == 'ar')
                            <a href="{{ route('locale', 'en') }}"
                               class="w-10 h-10 flex items-center justify-center rounded-full border border-brand-blue text-head-color hover:bg-brand-blue hover:text-white">EN</a>
                        @else
                            <a href="{{ route('locale', 'ar') }}"
                               class="w-10 h-10 flex items-center justify-center rounded-full border border-brand-blue text-head-color hover:bg-brand-blue hover:text-white">ع</a>
                        @endif
                        <a href="{{ env('PKI_LOGIN_URL') }}"
                           class="px-5 py-2.5 rounded-full bg-brand-blue text-white font-medium hover:opacity-90 flex items-center">
                            {{ __('general.navigation.login') }}
                            <img src="{{ asset('assets/images/arrow-right.svg') }}" class="ms-2" alt="">
                        </a>
                    </div>
                @endguest

                @auth
                    <div class="hidden md:flex items-center gap-3">
                        @if(session()->get('lang') == 'ar')
                            <a href="{{ route('locale', 'en') }}"
                               class="w-10 h-10 flex items-center justify-center rounded-full border border-brand-blue text-head-color hover:bg-brand-blue hover:text-white">EN</a>
                        @else
                            <a href="{{ route('locale', 'ar') }}"
                               class="w-10 h-10 flex items-center justify-center rounded-full border border-brand-blue text-head-color hover:bg-brand-blue hover:text-white">AR</a>
                        @endif

                        <!-- User menu -->
                        <div x-data="{ userOpen:false }" class="relative">
                            <button @click="userOpen=!userOpen" class="flex text-sm rounded-full focus:outline-none">
                                <img class="w-10 h-10 rounded-full object-cover"
                                     src="{{ auth()->user()?->profile?->avatar_url }}"
                                     alt="user photo">
                            </button>
                            <div x-cloak x-show="userOpen" @click.outside="userOpen=false" x-transition
                                 class="absolute right-0 mt-2 w-56 rounded-lg bg-white shadow border border-gray-100">
                                <div class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</div>
                                </div>
                                <div class="py-2">
                                    <a href="{{ route('filament.user.pages.dashboard') }}"
                                       class="block px-4 py-2 text-sm hover:bg-gray-50">
                                        {{ __('general.navigation.dashboard') }}
                                    </a>
                                    <a href="{{ env('PKI_LOGOUT_URL') }}"
                                       class="block px-4 py-2 text-sm hover:bg-gray-50">
                                        {{ __('general.navigation.sign-out') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth

                <!-- Mobile hamburger -->
                <button @click="open=!open"
                        class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg hover:bg-gray-100 focus:outline-none"
                        aria-label="Toggle navigation">
                    <svg x-show="!open" class="w-7 h-7" viewBox="0 0 17 14" fill="none">
                        <path d="M1 1h15M1 7h15M1 13h15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <svg x-show="open" x-cloak class="w-7 h-7" viewBox="0 0 24 24" fill="none">
                        <path d="M6 6l12 12M6 18L18 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-cloak x-show="open" x-transition
         class="md:hidden border-t border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 py-3">
            <ul class="flex flex-col gap-1 text-sm">
                <li><a href="/"
                       class="mobile-link {{ request()->path() == '/' ? 'active' : '' }}">{{ __('general.navigation.home') }}</a>
                </li>
                <li><a href="{{ route('about.index') }}"
                       class="mobile-link {{ request()->path() == 'about' ? 'active' : '' }}">{{ __('general.navigation.about') }}</a>
                </li>
                <li><a href="{{ route('digital-library.index') }}"
                       class="mobile-link {{ request()->path() == 'digital-library' ? 'active' : '' }}">{{ __('general.navigation.digital-library') }}</a>
                </li>
                <li><a href="{{ route('future-skills.index') }}"
                       class="mobile-link {{ request()->path() == 'future-skills' ? 'active' : '' }}">{{ __('general.navigation.future-skills') }}</a>
                </li>
                <li><a href="{{ route('media-center.index') }}"
                       class="mobile-link {{ request()->path() == 'media-center' ? 'active' : '' }}">{{ __('general.navigation.media-center') }}</a>
                </li>

                <!-- Mobile accordion: Social Window -->
                <li>
                    <button @click="dd.social=!dd.social" class="mobile-link flex w-full items-center justify-between">
                        {{ __('general.navigation.social-window') }}
                        <svg :class="dd.social ? 'rotate-180' : ''" class="w-4 h-4 transition-transform"
                             viewBox="0 0 10 6" fill="none">
                            <path d="m1 1 4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <div x-show="dd.social" x-transition x-cloak class="mt-1 ms-3 flex flex-col">
                        <a href="{{ route('social-window.index') }}"
                           class="mobile-sublink">{{ __('general.navigation.profiles') }}</a>
                        <a href="{{ route('social-window.experts') }}"
                           class="mobile-sublink">{{ __('general.navigation.experts') }}</a>
                        <a href="{{ route('jobs.index') }}"
                           class="mobile-sublink">{{ __('general.navigation.jobs') }}</a>
                        <a href="{{ route('works.index') }}"
                           class="mobile-sublink">{{ __('general.navigation.works') }}</a>
                    </div>
                </li>

                <!-- Mobile accordion: International -->
                {{--                <li>--}}
                {{--                    <button @click="dd.intl=!dd.intl" class="mobile-link flex w-full items-center justify-between">--}}
                {{--                        {{ __('general.navigation.international-talents') }}--}}
                {{--                        <svg :class="dd.intl ? 'rotate-180' : ''" class="w-4 h-4 transition-transform"--}}
                {{--                             viewBox="0 0 10 6" fill="none">--}}
                {{--                            <path d="m1 1 4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>--}}
                {{--                        </svg>--}}
                {{--                    </button>--}}
                {{--                    <div x-show="dd.intl" x-transition x-cloak class="mt-1 ms-3 flex flex-col">--}}
                {{--                        <a href="{{ route('international-talents.index') }}"--}}
                {{--                           class="mobile-sublink">{{ __('general.navigation.international-talents') }}</a>--}}
                {{--                        <a href="{{ route('international-talent-requests.index') }}"--}}
                {{--                           class="mobile-sublink">{{ __('general.navigation.international-talent-request') }}</a>--}}
                {{--                    </div>--}}
                {{--                </li>--}}

                <!-- Mobile accordion: Oman Scientists -->
                <li>
                    <button @click="dd.oman=!dd.oman" class="mobile-link flex w-full items-center justify-between">
                        {{ __('general.navigation.oman-scientists') }}
                        <svg :class="dd.oman ? 'rotate-180' : ''" class="w-4 h-4 transition-transform"
                             viewBox="0 0 10 6" fill="none">
                            <path d="m1 1 4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <div x-show="dd.oman" x-transition x-cloak class="mt-1 ms-3 flex flex-col">
                        <a href="{{ route('social-window.researchers') }}"
                           class="mobile-sublink">{{ __('general.navigation.researchers') }}</a>
                        <a href="{{ route('social-window.innovators') }}"
                           class="mobile-sublink">{{ __('general.navigation.innovators') }}</a>
                    </div>
                </li>

                <li><a href="{{ route('scale.index') }}"
                       class="mobile-link {{ request()->path() == 'scale' ? 'active' : '' }}">{{ __('general.navigation.scale') }}</a>
                </li>
                <li><a href="{{ route('contact.index') }}"
                       class="mobile-link {{ request()->path() == 'contact' ? 'active' : '' }}">{{ __('general.navigation.contact-us') }}</a>
                </li>

                <!-- Mobile: Auth & Language -->
                <li class="mt-2 border-t pt-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        @if(session()->get('lang') == 'ar')
                            <a href="{{ route('locale', 'en') }}"
                               class="w-10 h-10 flex items-center justify-center rounded-full border border-brand-blue hover:bg-brand-blue hover:text-white">EN</a>
                        @else
                            <a href="{{ route('locale', 'ar') }}"
                               class="w-10 h-10 flex items-center justify-center rounded-full border border-brand-blue hover:bg-brand-blue hover:text-white">ع</a>
                        @endif
                    </div>

                    @guest
                        <a href="{{ env('PKI_LOGIN_URL') }}"
                           class="px-4 py-2 rounded-full bg-brand-blue text-white font-medium hover:opacity-90">
                            {{ __('general.navigation.login') }}
                        </a>
                    @endguest

                    @auth
                        <div class="flex items-center gap-3">
                            <a href="{{ route('filament.user.pages.dashboard') }}"
                               class="underline text-sm">{{ __('general.navigation.dashboard') }}</a>
                            <a href="{{ env('PKI_LOGOUT_URL') }}"
                               class="underline text-sm">{{ __('general.navigation.sign-out') }}</a>
                            <img class="w-9 h-9 rounded-full object-cover"
                                 src="{{ auth()->user()?->profile?->avatar_url }}" alt="user photo">
                        </div>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Extras: small utility classes -->
<style>
    .nav_link {
        @apply py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-2 text-gray-900 md:hover:text-brand-blue transition;
    }

    .nav_link.active {
        @apply text-brand-blue;
    }

    .mobile-link {
        @apply block w-full rounded-md px-3 py-2 text-gray-900 hover:bg-gray-50;
    }

    .mobile-link.active {
        @apply text-brand-blue;
    }

    .mobile-sublink {
        @apply block rounded px-3 py-2 text-gray-700 hover:bg-gray-50;
    }
</style>

<!-- If you don't already include Alpine, add this once (e.g., in your base layout) -->
{{-- <script defer src="//unpkg.com/alpinejs" ></script> --}}
