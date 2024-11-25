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
                        <a href="{{ route('social-window.index') }}" class="nav_link">Social Window</a>
                    </li>
                    <li>
                        <a href="{{ route('jobs.index') }}" class="nav_link">Jobs</a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}" class="nav_link">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="nav_btn flex items-center hidden lg:flex">
                <a href="#" class="px-8 py-3 rounded-full border border-primary-2 text-head-color font-medium hover:bg-primary-2 hover:text-white">Join as Talent</a>
                <svg width="50" height="51" viewBox="0 0 50 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="0.276367" width="50" height="50" rx="25" fill="#2E3192"/>
                    <path d="M18.2185 32.3351C18.2185 32.3351 24.7534 25.8 32.2269 18.3265M32.2269 18.3265C26.8281 23.7253 20.3156 19.2059 20.3156 19.2059M32.2269 18.3265C26.8281 23.7253 31.3475 30.2378 31.3475 30.2378" stroke="white" stroke-width="1.42857"/>
                </svg>
            </div>
        </div>
    </div>
</nav>
<!-- Header -->
