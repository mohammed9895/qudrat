<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-24 md:pt-10 pb-5">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.media-center.page-title') }}</h2>
                    <h2 class="mt-5 text-xl">{{ __('general.media-center.sub-title') }}</h2>
                </div>
                <div class="w-6/12">
                    <div class="text-end">
                        <img src="assets/images/banner_2.png" alt="images" class="hidden md:block">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Card & Siderbar -->
    <div class="pt-24 pb-12">
        <div class="container">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($posts as $post)
                    <div class="">
                        <div class="bg-white p-5 rounded-xl shadow-default">
                            <img src="{{ $post->getThumbnailImage() }}" alt="images" class="w-full mb-4 rounded-md">
                            <a href=""
                               class="inline-block text-2xl font-medium mb-3 hover:text-primary-1">{{ $post->title }}</a>
                            <p class="mb-4">{{ substr($post->content, 0, 100) }} ...</p>
                            <a href="{{ route('media-center.post', [$post]) }}"
                               class="inline-block px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">View
                                Resource</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-5">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
    <!-- /Card & Siderbar -->
</div>
