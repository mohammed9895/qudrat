@php use Carbon\Carbon; @endphp
<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-24 md:pt-40 pb-5">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $post->title }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <!-- Card & Siderbar -->
    <div class="pt-24 pb-12">
        <div class="container bg-white px-5 py-5 rounded-lg">
            <div class="w-full h-[400px] rounded-lg mb-5"
                 style="background: url({{ $post->getThumbnailImage() }}); background-size: cover; background-position: center center;"></div>
            <h1 class="text-2xl text-gray-900 font-bold mb-5">{{ $post->title }}</h1>
            <div class="flex justify-start items-center space-x-3 mb-5">
                <div class="flex items-center">
                    @svg('hugeicons-user-circle', 'w-6 h-6 text-primary-1 mr-2')
                    <span>{{ $post->author->name }}</span>
                </div>
                <div class="flex items-center">
                    @svg('hugeicons-calendar-02', 'w-6 h-6 text-primary-1 mr-2')
                    <span>{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
                </div>
            </div>
            <div class="text-gray-700 mb-5">{!! $post->description !!}</div>
        </div>
    </div>
    <!-- /Card & Siderbar -->

    <!-- Comment Section -->
    <section class="py-8 lg:py-16 antialiased">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900">{{ __('general.comments.comments') }} ({{ $post->comments()->count();}})</h2>
            </div>
            <form class="mb-6" wire:submit="comment">
                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 ">
                    <textarea id="comment" wire:model="content" rows="6"
                              class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                              placeholder="{{ __('general.comments.placeholder') }}" required></textarea>
                </div>
                <button type="submit"
                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-1 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-primary-800">
                   {{ __('general.comments.submit') }}
                </button>
            </form>
            @foreach($post->comments as $comment)
                <article class="p-6 text-base bg-white rounded-lg mb-3">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900  font-semibold"><img
                                    class="mr-2 w-6 h-6 rounded-full"
                                    {{--                                    src="{{ $comment->user->profile->avatar ? '/storage/' . $comment->user->profile->avatar : '/assets/images/unset.jpg' }}"--}}
                                    src="/assets/images/unset.jpg"
                                    alt="Michael Gough">{{ $comment->user->name }}</p>
                            <p class="text-sm text-gray-600">
                                <time pubdate datetime="2022-02-08"
                                      title="February 8th, 2022">{{ Carbon::parse($comment->created_at)->format('M d. Y') }}</time>
                            </p>
                        </div>
                    </footer>
                    <p class="text-gray-500 ">{{ $comment->content }}</p>
                
                </article>
            @endforeach
        </div>
    </section>
    <!-- Comment Section -->

</div>
