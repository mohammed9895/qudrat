@php
    use App\Models\Category;use SolutionForest\FilamentCms\Facades\FilamentCms;$menu = FilamentCms::getNavigation('footer') ?? [];

    $categories = Category::latest()->limit(5)->get();
@endphp
    <!-- Footer -->
     <!-- component -->
<div x-data="{show:false}">
    <button
     @click="show = !show"
    class="fixed bottom-4 right-4 inline-flex items-center justify-center text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border rounded-full w-16 h-16 bg-black hover:bg-gray-700 m-0 cursor-pointer border-gray-200 bg-none p-0 normal-case leading-5 hover:text-gray-900"
    type="button" aria-haspopup="dialog" aria-expanded="false" data-state="closed">
    <svg xmlns=" http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="text-white block border-gray-200 align-middle">
      <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" class="border-gray-200">
      </path>
    </svg>
  </button>


  <div  x-show="show" style="box-shadow: 0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgb(0 0 0 / 0.05);"
    class="fixed bottom-[calc(4rem+1.5rem)] right-0 mr-4 bg-white p-6 rounded-lg border border-[#e5e7eb] w-[440px] h-[634px]">

    <!-- Heading -->
    <div class="flex flex-col space-y-1.5 pb-6">
      <h2 class="font-semibold text-lg tracking-tight">Chatbot</h2>
      <!-- <p class="text-sm text-[#6b7280] leading-3">Powered by Mendable and Vercel</p> -->
    </div>




    <!-- Chat Container -->
    <div  class="pr-4 h-[474px]" style="min-width: 100%; display: table;">
      <!-- Chat Message AI -->
      <!-- <div class="flex gap-3 my-4 text-gray-600 text-sm flex-1"><span
          class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
          <div class="rounded-full bg-gray-100 border p-1"><svg stroke="none" fill="black" stroke-width="1.5"
              viewBox="0 0 24 24" aria-hidden="true" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z">
              </path>
            </svg></div>
        </span>
        <p class="leading-relaxed"><span class="block font-bold text-gray-700">AI </span>Hi, how can I help you today?
        </p>
      </div> -->

      <!--  User Chat Message -->
      <!-- <div class="flex gap-3 my-4 text-gray-600 text-sm flex-1"><span
          class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
          <div class="rounded-full bg-gray-100 border p-1"><svg stroke="none" fill="black" stroke-width="0"
              viewBox="0 0 16 16" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z">
              </path>
            </svg></div>
        </span>
        <p class="leading-relaxed"><span class="block font-bold text-gray-700">You </span>fewafef</p>
      </div>
       Ai Chat Message  -->
      <!-- <div class="flex gap-3 my-4 text-gray-600 text-sm flex-1"><span
          class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
          <div class="rounded-full bg-gray-100 border p-1"><svg stroke="none" fill="black" stroke-width="1.5"
              viewBox="0 0 24 24" aria-hidden="true" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z">
              </path>
            </svg></div>
        </span>
        <p class="leading-relaxed"><span class="block font-bold text-gray-700">AI </span>Sorry, I couldn't find any
          information in the documentation about that. Expect answer to be less accurateI could not find the answer to
          this in the verified sources.</p>
      </div>
    </div> -->
    <!-- Input box  -->
    <div class="flex items-center pt-0">
      <form class="flex items-center justify-center w-full space-x-2">
        <input
          class="flex h-10 w-full rounded-md border border-[#e5e7eb] px-3 py-2 text-sm placeholder-[#6b7280] focus:outline-none focus:ring-2 focus:ring-[#9ca3af] disabled:cursor-not-allowed disabled:opacity-50 text-[#030712] focus-visible:ring-offset-2"
          placeholder="Type your message" value="">
        <button
          class="inline-flex items-center justify-center rounded-md text-sm font-medium text-[#f9fafb] disabled:pointer-events-none disabled:opacity-50 bg-black hover:bg-[#111827E6] h-10 px-4 py-2">
          Send</button>
      </form>
    </div>

  </div>
</div>
<footer class="bg-brand-blue pt-24">
    <div class="container">
        <div class="flex justify-between gap-5 sm:gap-6 flex-wrap pb-20">
            <div class="w-full sm:w-5/12 xl:w-4/12 2xl:w-3/12">
                <img src="{{ asset('assets/images/white-logo.svg')}}" alt="images" class="mb-7 w-20">
                <p class="text-white mb-14 text-justify">{{ __('general.footer.about-text') }}</p>
                <h6 class="text-white text-base mb-2">{{ __('general.footer.social-media') }}</h6>
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
                    <h6 class="text-white text-xl font-semibold mb-2">{{ __('general.footer.categories') }}</h6>
                    <svg width="44" height="2" viewBox="0 0 44 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1H43.6904" stroke="#3CC7BC" stroke-width="2"/>
                    </svg>
                </div>
                <ul class="flex flex-col gap-4">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('social-window.category', $category) }}"
                               class="text-[#fff] hover:text-primary-1">{{ $category->name }}</a>
                        </li>
                    @endforeach
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
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.useful-link.browse-jobs') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('social-window.index') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.useful-link.browse-categories') }}</a>
                    </li>
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
                        <a href="{{ route('filament.entity.resources.job-applications.create') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.focal-point.add-jobs') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('social-window.index') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.focal-point.browse-categories') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('social-window.index') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.focal-point.browse-profiles') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('media-center.index') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.focal-point.media-center') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('social-window.index') }}"
                           class="text-[#fff] hover:text-primary-1">{{ __('general.footer.focal-point.social-window') }}</a>
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
