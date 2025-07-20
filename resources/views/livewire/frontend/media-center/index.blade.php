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
            <div class="grid grid-cols-12 gap-5">

                <div class="col-span-full md:col-span-4 xl:col-span-3">
                    <div class="bg-white p-6 rounded-xl w-full">
                        {{ $this->form }}
                    </div>
                </div>
                <div class="col-span-full xl:col-span-9">
                    <div class="flex justify-end mb-4 space-x-3 rtl:space-x-reverse w-full">
                        <div class="flex space-x-3 rtl:space-x-reverse ">
                            <div class="flex space-x-3 rtl:space-x-reverse">
                                <button wire:click="toggleOrderDirection"
                                        class="text-sm px-4 py-2 border rounded {{ $orderDirection === 'desc' ? 'bg-primary-1 text-white' : 'bg-white' }}">
                                    @if($orderDirection === 'desc')
                                        <x-hugeicons-sort-by-down-02 class="w-5 h-5"/>
                                    @else
                                        <x-hugeicons-sort-by-up-02 class="w-5 h-5"/>
                                    @endif
                                </button>
                                <button wire:click="$set('viewMode', 'grid')"
                                        class="text-sm px-4 py-2 border rounded {{ $viewMode === 'grid' ? 'bg-primary-1 text-white' : 'bg-white' }}">
                                    <x-hugeicons-grid-table/>
                                </button>
                                <button wire:click="$set('viewMode', 'list')"
                                        class="text-sm px-4 py-2 border rounded {{ $viewMode === 'list' ? 'bg-primary-1 text-white' : 'bg-white' }}">
                                    <x-hugeicons-list-view/>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="{{ $viewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 gap-10' : 'space-y-6' }}">
                        @foreach($this->posts as $post)
                            @if($viewMode === 'grid')
                                <div class="">
                                    <div class="bg-white p-5 rounded-xl shadow-default">
                                        <img src="{{ $post->getThumbnailImage() }}" alt="images"
                                             class="w-full mb-4 rounded-md">
                                        <a href="{{ route('media-center.post', [$post]) }}"
                                           class="inline-block text-2xl font-medium mb-3 hover:text-primary-1">{{ $post->title }}</a>
                                        <p class="mb-4">{{ Str::limit(strip_tags($post->content), 300) }}</p>
                                        <a href="{{ route('media-center.post', [$post]) }}"
                                           class="inline-block px-8 py-3 rounded-full text-head-color font-medium bg-primary-1 text-white inline-flex items-center gap-2">
                                            {{ __('general.view-resoucre') }}
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="bg-white p-6 rounded-xl shadow-default flex flex-col md:flex-row gap-6">
                                    <img src="{{ $post->getThumbnailImage() }}" alt="images"
                                         class="w-full md:w-1/4 rounded-md">
                                    <div class="flex-1">
                                        <a href="{{ route('media-center.post', [$post]) }}"
                                           class="block text-2xl font-medium mb-2 hover:text-primary-1">{{ $post->title }}</a>
                                        <p class="mb-4">{{ Str::limit(strip_tags($post->content), 300) }}</p>
                                        <a href="{{ route('media-center.post', [$post]) }}"
                                           class="inline-block px-6 py-2 rounded-full bg-primary-1 text-white text-sm">
                                            {{ __('general.view-resoucre') }}
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $this->posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Card & Siderbar -->
</div>
