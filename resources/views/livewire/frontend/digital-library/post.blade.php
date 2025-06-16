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
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900">Comments ({{ $post->comments()->count();}})</h2>
            </div>
            <form class="mb-6" wire:submit="comment">
                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 ">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea id="comment" wire:model="content" rows="6"
                              class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                              placeholder="Write a comment..." required></textarea>
                </div>
                <button type="submit"
                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-1 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-primary-800">
                    Post comment
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
                        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500  bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 "
                                type="button">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 16 3">
                                <path
                                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                            </svg>
                            <span class="sr-only">Comment settings</span>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownComment1"
                             class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow">
                            <ul class="py-1 text-sm text-gray-700"
                                aria-labelledby="dropdownMenuIconHorizontalButton">
                                @if($comment->user->id == auth()->user()->id)
                                    <li>
                                        <a wire:click="deleteComment({{ $comment->id }})"
                                           class="block py-2 px-4 hover:bg-gray-100">Remove</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="#"
                                       class="block py-2 px-4 hover:bg-gray-100">Report</a>
                                </li>
                            </ul>
                        </div>
                    </footer>
                    <p class="text-gray-500 ">{{ $comment->content }}</p>
                    <div class="flex items-center mt-4 space-x-4">
                        <button type="button"
                                class="flex items-center text-sm text-gray-500 hover:underline  font-medium">
                            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                            </svg>
                            Reply
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
    <!-- Comment Section -->

</div>
