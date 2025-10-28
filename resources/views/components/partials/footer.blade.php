@php
    $categories = App\Models\Category::latest()->limit(5)->get();
@endphp

<link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/21.1.3/css/dx.common.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/21.1.3/css/dx.light.css"/>
<script src="https://cdn3.devexpress.com/jslib/21.1.3/js/dx.all.js"></script>


<script>
    window.embeddedChatbotConfig = {
        chatbotId: "5lv7SA33vTh2q_0yEykf9",
        domain: "www.chatbase.co"
    }
</script>

<script
    src="https://www.chatbase.co/embed.min.js"
    chatbotId="5lv7SA33vTh2q_0yEykf9"
    domain="www.chatbase.co"
    defer>
</script>
<a
    href="{{ route('feedbacks.index') }}"
    class="fixed bottom-4 left-4 inline-flex items-center justify-center text-sm font-medium border rounded-full bg-brand-blue text-white hover:bg-brand-green m-0 cursor-pointer  px-3 py-2 normal-case leading-5 hover:text-white z-[10000]"
    type="button" aria-haspopup="dialog" aria-expanded="false" data-state="closed">
    <span>📢 شاركنا رأيك في استطلاع رأي المستخدمين</span>
</a>
<!-- Footer -->
<footer class="bg-brand-blue pt-24">
    <div class="container">
        <div class="flex justify-between gap-5 sm:gap-6 flex-wrap pb-20">
            <div class="w-full sm:w-5/12 xl:w-4/12 2xl:w-3/12">
                <img src="{{ asset('assets/images/white-logo.svg')}}" alt="images" class="mb-7 w-20">
                <p class="text-white mb-14 text-justify">{{ __('general.footer.about-text') }}</p>
                <h6 class="text-white text-base mb-2">{{ __('general.footer.social-media') }}</h6>
                <ul class="flex items-center gap-x-3">
                    <li>
                        <a href="https://www.youtube.com/user/Omanlabour"
                           class="w-9 h-9 flex items-center justify-center rounded-full text-white bg-white bg-opacity-10 hover:bg-primary-1"><i
                                class="lab la-youtube"></i></a>
                    </li>
                    <li>
                        <a href="https://x.com/labour_oman"
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
                        <a href="https://www.instagram.com/labour_oman/"
                           class="w-9 h-9 flex items-center justify-center rounded-full text-white bg-white bg-opacity-10 hover:bg-primary-1">
                            @svg('fab-instagram', 'w-5 h-5 text-white')
                        </a>
                    </li>
                </ul>
            </div>
            <div class="w-full sm:w-5/12 xl:w-2/12">
                <div class="mb-7">
                    <h6 class="text-white text-xl font-semibold mb-2">{{ __('general.footer.for-user') }}</h6>
                    <svg width="44" height="2" viewBox="0 0 44 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1H43.6904" stroke="#3CC7BC" stroke-width="2"/>
                    </svg>
                </div>
                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="{{ route('jobs.index') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.jobs') }}</a>
                    </li>
                    {{--                    <li>--}}
                    {{--                        <a href="{{ route('social-window.index') }}"--}}
                    {{--                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.useful-link.browse-categories') }}</a>--}}
                    {{--                    </li>--}}
                    <li>
                        <a href="{{ route('social-window.index') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.useful-link.browse-profiles') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('media-center.index') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.useful-link.media-center') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('social-window.index') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.useful-link.social-window') }}</a>
                    </li>
                </ul>
            </div>
            <div class="w-full sm:w-5/12 xl:w-2/12">
                <div class="mb-7">
                    <h6 class="text-white text-xl font-semibold mb-2">{{ __('general.footer.for-employer') }}</h6>
                    <svg width="44" height="2" viewBox="0 0 44 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1H43.6904" stroke="#3CC7BC" stroke-width="2"/>
                    </svg>
                </div>
                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="https://mol.gov.om/WebLinks"
                           target="_blank"
                           class="text-[#fff] hover:text-primary-1">
                            {{ __('general.footer.focal-point.site-policies') }}
                        </a>
                    </li>
                    <li>
                        <a href="https://mol.gov.om/WebLinks"
                           target="_blank"
                           class="text-[#fff] hover:text-primary-1">
                            {{ __('general.footer.focal-point.privacy') }}
                        </a>
                    </li>
                    <li>
                        <a href="https://mol.gov.om/WebLinks"
                           target="_blank"
                           class="text-[#fff] hover:text-primary-1">
                            {{ __('general.footer.focal-point.terms') }}
                        </a>
                    </li>
                    <li>
                        <a href="https://mol.gov.om/WebLinks"
                           target="_blank"
                           class="text-[#fff] hover:text-primary-1">
                            {{ __('general.footer.focal-point.accessibility') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="block border border-primary-1 border-opacity-10">
        <div class="py-4 flex justify-center">
            <div class="text-center">
                <p class="text-white">{{ __('general.footer.copy-right') }}</p>
            </div>
        </div>
    </div>
</footer>
<!-- /Footer -->
