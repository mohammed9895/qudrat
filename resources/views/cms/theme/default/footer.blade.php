@php
    use SolutionForest\FilamentCms\Facades\FilamentCms;$menu = FilamentCms::getNavigation('footer') ?? [];
@endphp
    <!-- Footer -->
<footer class="bg-primary-4 pt-24">
    <div class="container">
        <div class="flex justify-between gap-5 sm:gap-6 flex-wrap pb-20">
            <div class="w-full sm:w-5/12 xl:w-4/12 2xl:w-3/12">
                <img src="{{ asset('assets/images/logo_white.png')}}" alt="images" class="mb-7">
                <p class="text-white mb-14">We’re always in search for talented and motivated people. Don’t be shy
                    introduce yourself Subscribe news, exclusive offers & delivered right to your inbox!!</p>
                <h6 class="text-white text-base mb-2">Social Media</h6>
                <ul class="flex items-center gap-x-3">
                    <li>
                        <a href="https://www.facebook.com/"
                           class="w-9 h-9 flex items-center justify-center rounded-full text-white bg-white bg-opacity-10 hover:bg-primary-1"><i
                                class="ri-facebook-fill"></i></a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/"
                           class="w-9 h-9 flex items-center justify-center rounded-full text-white bg-white bg-opacity-10 hover:bg-primary-1"><i
                                class="lab la-youtube"></i></a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/"
                           class="w-9 h-9 flex items-center justify-center rounded-full text-white bg-white bg-opacity-10 hover:bg-primary-1">
                                <span>
                                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.273 0H0.5L6.132 7.71L0.807 14H2.614L6.969 8.856L10.727 14H15.5L9.631 5.966L14.682 0H12.875L8.794 4.82L5.273 0ZM11.409 12.6L3.227 1.4H4.591L12.773 12.6H11.409Z"
                                            fill="white"/>
                                    </svg>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/"
                           class="w-9 h-9 flex items-center justify-center rounded-full text-white bg-white bg-opacity-10 hover:bg-primary-1"><i
                                class="las la-basketball-ball"></i></a>
                    </li>
                </ul>
            </div>
            <div class="w-full sm:w-5/12 xl:w-2/12">
                <div class="mb-7">
                    <h6 class="text-white text-xl font-semibold mb-2">Categories</h6>
                    <svg width="44" height="2" viewBox="0 0 44 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1H43.6904" stroke="#3CC7BC" stroke-width="2"/>
                    </svg>
                </div>
                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Graphics & Design</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Digital Marketing</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Writing & Translation</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Video & Animation</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Music & Audio</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Programming & Tech</a>
                    </li>
                </ul>
            </div>
            <div class="w-full sm:w-5/12 xl:w-2/12">
                <div class="mb-7">
                    <h6 class="text-white text-xl font-semibold mb-2">For Candidates</h6>
                    <svg width="44" height="2" viewBox="0 0 44 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1H43.6904" stroke="#3CC7BC" stroke-width="2"/>
                    </svg>
                </div>
                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Candidate Dashboard</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Browse jobs</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Browse Categories</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">My Proposals</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">My Services</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Job Alerts</a>
                    </li>
                </ul>
            </div>
            <div class="w-full sm:w-5/12 xl:w-2/12">
                <div class="mb-7">
                    <h6 class="text-white text-xl font-semibold mb-2">For Employer</h6>
                    <svg width="44" height="2" viewBox="0 0 44 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1H43.6904" stroke="#3CC7BC" stroke-width="2"/>
                    </svg>
                </div>
                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Employer Dashboard</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Browse Candidates</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Submit jobs</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Submit jobs</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Job Packages</a>
                    </li>
                    <li>
                        <a href="" class="text-[#B1B1B1] hover:text-primary-1">Applicants jobs</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="block border border-primary-1 border-opacity-10">
        <div class="py-4 flex justify-center">
            <div class="text-center">
                <p class="text-white">Copyright @2024ll Rights Reserved by </p>
            </div>
        </div>
    </div>
</footer>
<!-- /Footer -->
