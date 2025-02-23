<!-- Header -->
<nav class="nav_area">
    <div class="px-10">
        <div class="flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('assets/images/logo.svg')}}" width="150" alt="" class="">
            </a>

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:px-7 mt-4 border border-gray-100 md:rounded-full bg-gray-50 md:flex-row md:space-x-4 rtl:md:space-x-reverse md:mt-0 md:border-0 md:bg-white md:shadow-default">
                    <li>
                        <a href="/" class="nav_link {{ request()->path() == '/' ? 'active' : '' }}"
                           aria-current="page">{{ __('general.navigation.home') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('about.index') }}"
                           class="nav_link {{ request()->path() == 'about' ? 'active' : '' }}">{{ __('general.navigation.about') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('digital-library.index') }}"
                           class="nav_link {{ request()->path() == 'digital-library' ? 'active' : '' }}">{{ __('general.navigation.digital-library') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('future-skills.index') }}"
                           class="nav_link {{ request()->path() == 'future-skills' ? 'active' : '' }}">{{ __('general.navigation.future-skills') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('media-center.index') }}"
                           class="nav_link {{ request()->path() == 'media-center' ? 'active' : '' }}">{{ __('general.navigation.media-center') }}</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                class="flex items-center justify-between w-full {{ request()->path() == 'social-window' ? 'active' : '' }} py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-brand-blue md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                            {{ __('general.navigation.social-window') }}
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                             class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('social-window.index') }}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ __('general.navigation.profiles') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('social-window.experts') }}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ __('general.navigation.experts') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('jobs.index') }}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ __('general.navigation.jobs') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('works.index') }}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ __('general.navigation.works') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar-oman"
                                class="flex items-center justify-between {{ request()->path() == 'social-window/' ? 'active' : '' }} w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-brand-blue md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                            {{ __('general.navigation.oman-scientists') }}
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar-oman"
                             class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('social-window.researchers') }}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ __('general.navigation.researchers') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('social-window.innovators') }}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        {{ __('general.navigation.innovators') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}"
                           class="nav_link {{ request()->path() == 'contact' ? 'active' : '' }}">{{ __('general.navigation.contact-us') }}</a>
                    </li>
                </ul>
            </div>


            @guest()
                <div class="nav_btn items-center hidden lg:flex">
                    @if(session()->get('lang') == 'ar')
                        <a href="{{ route('locale', 'en') }}"
                           class="w-[50px] h-[50px] flex items-center rtl:ml-1 justify-center rounded-full border border-brand-blue text-head-color font-medium hover:bg-brand-blue hover:text-white">EN</a>
                    @else
                        <a href="{{ route('locale', 'ar') }}"
                           class="w-[50px] h-[50px] flex items-center justify-center rounded-full border border-brand-blue text-head-color font-medium hover:bg-brand-blue hover:text-white">ع</a>
                    @endif
                    <a href="{{ route('filament.user.auth.register') }}"
                       class="px-8 py-3 rounded-full border border-brand-blue text-head-color font-medium hover:bg-brand-blue hover:text-white">
                        {{ __('general.navigation.register') }}
                    </a>
                    <a href="{{ route('filament.user.auth.login') }}"
                       class="px-8 py-3 rounded-full border bg-brand-blue text-head-color font-medium hover:bg-primary-1 text-white flex items-center justify-center">
                        {{ __('general.navigation.login') }}
                        <img src="{{ asset('assets/images/arrow-right.svg') }}" class="ml-2 rtl:mr-2 rtl:ml-0" alt="">
                    </a>
                </div>
            @endguest
            @auth()
                <div class="flex items-center justify-center md:order-2 space-x-3 md:space-x-3 rtl:space-x-reverse">
                    @if(session()->get('lang') == 'ar')
                        <a href="{{ route('locale', 'en') }}"
                           class="w-[50px] h-[50px] flex items-center justify-center rounded-full border border-brand-blue text-head-color font-medium hover:bg-brand-blue hover:text-white">EN</a>
                    @else
                        <a href="{{ route('locale', 'ar') }}"
                           class="w-[50px] h-[50px] flex items-center justify-center rounded-full border border-brand-blue text-head-color font-medium hover:bg-brand-blue hover:text-white">AR</a>
                    @endif
                    <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                            data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-[50px] h-[50px] rounded-full" src="/storage/{{ auth()->user()->profile->avatar }}"
                             alt="user photo">
                    </button>
                    <!-- Dropdown menu -->
                    <div
                        class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ auth()->user()->name }}</span>
                            <span
                                class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{ route('filament.user.pages.dashboard') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">{{ __('general.navigation.dashboard') }}</a>
                            </li>
                            <li>
                                <form action="{{ route('filament.user.auth.logout') }}" method="POST"
                                      class="">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full text-left rtl:text-right px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">{{ __('general.navigation.sign-out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <button data-collapse-toggle="navbar-user" type="button"
                            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            aria-controls="navbar-user" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
            @endauth
        </div>
    </div>
</nav>
<!-- Header -->
