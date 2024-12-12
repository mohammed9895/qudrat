<!-- Header -->
<nav class="nav_area">
    <div class="px-10">
        <div class="flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('assets/images/logo.svg')}}" width="150" alt="" class="">
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:px-7 mt-4 border border-gray-100 md:rounded-full bg-gray-50 md:flex-row md:space-x-4 md:mt-0 md:border-0 md:bg-white md:shadow-default">
                    <li>
                        <a href="/" class="nav_link active" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('about.index') }}" class="nav_link">About</a>
                    </li>
                    <li>
                        <a href="{{ route('digital-library.index') }}" class="nav_link">Digital Library</a>
                    </li>
                    <li>
                        <a href="{{ route('future-skills.index') }}" class="nav_link">Future Skills</a>
                    </li>
                    <li>
                        <a href="{{ route('media-center.index') }}" class="nav_link">Media Center</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Social Window <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('social-window.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profiles</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Experts</a>
                                </li>
                                <li>
                                    <a href="{{ route('jobs.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Jobs</a>
                                </li>
                                <li>
                                    <a href="{{ route('works.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Works</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar-oman" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Oman Scientists <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar-oman" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('social-window.category', 'researchers') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Researchers</a>
                                </li>
                                <li>
                                    <a href="{{ route('social-window.category', 'innovators') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Innovators</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}" class="nav_link">Contact</a>
                    </li>
                </ul>
            </div>
            @guest()
            <div class="nav_btn flex items-center hidden lg:flex">
                <a href="{{ route('filament.user.auth.register') }}" class="px-8 py-3 rounded-full border border-primary-2 text-head-color font-medium hover:bg-primary-2 hover:text-white">Register</a>
                <a href="{{ route('filament.user.auth.login') }}" class="px-8 py-3 rounded-full border bg-primary-2 text-head-color font-medium hover:bg-primary-1 text-white flex items-center justify-center">
                    Login
                    <img src="{{ asset('assets/images/arrow-right.svg') }}" class="ml-2" alt="">
                </a>
            </div>
            @endguest
            @auth()
                <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="/storage/{{ auth()->user()->profile->avatar }}" alt="user photo">
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ auth()->user()->name }}</span>
                            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{ route('filament.user.pages.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('filament.user.auth.logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                            </li>
                        </ul>
                    </div>
                    <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
            @endauth
        </div>
    </div>
</nav>
<!-- Header -->
