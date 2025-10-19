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


    <!-- Card & Siderbar -->
    <div class="pt-24 pb-12">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($jobs as $link)
                    <div class="p-5 rounded-xl shadow-default h-[400px] relative flex justify-start items-end"
                         style="background: url('{{ $link->getThumbnailImage() }}'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
                        <div class="absolute inset-0 bg-black/10 z-10 rounded-xl"></div>
                        <div class="z-50 relative w-full md:w-3/4">
                            <a href=""
                               class="inline-block text-2xl font-medium mb-3 text-black hover:text-primary-1">{{ $link->name }}</a>
                            <p class="mb-4 text-gray-500">{{ $link->description }}</p>
                            <a href="{{ $link->url }}" target="_blank"
                               class="inline-block px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">{{ __('general.digital-library.view-now') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /Card & Siderbar -->
</div>
