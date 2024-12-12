<div>
    <!-- Banner -->
    <div class="bg-primary-3 pt-[160px] pb-28">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs />
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ $category->name }}</h2>
                </div>
                <div class="w-6/12">
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

    <div class="container py-24">
        <div class="grid grid-cols-4 gap-5">
            @foreach($category->works as $work)
                <div class="bg-white border-[3px] border-white rounded-xl p-3 relative hover:bg-white transition-all">
                    <div class="w-full mb-4">
                        <div class="rounded-md w-full h-36" style="background: url('/storage/{{ $work->cover }}'); background-size: cover; background-position: center center;"></div>
                    </div>
                    <h4 class="text-xl font-medium mb-2">{{ $work->title }}</h4>

                    <div class="flex items-center justify-start space-x-2">
                        <a href="{{ route('works.category', $work->workCategory) }}" class="text-sm mt- mb-4 inline-flex items-center justify-center" >
                            <x-hugeicons-sticky-note-02 class="size-5 mr-1 text-primary-1" />
                            <span>{{ $work->workCategory->name }}</span>
                        </a>
                        <div class="text-sm mt- mb-4 inline-flex items-center justify-center" >
                            <x-hugeicons-calendar-03 class="size-5 mr-1 text-primary-1" />
                            <span>{{ \Carbon\Carbon::parse($work->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                    @if($work->skills)
                        <div class="flex items-center gap-1 flex-wrap mb-4">
                            @foreach($work->skills as $skill)
                                <a href="{{ route('works.skill', $skill) }}" class="px-3 py-1 inline-flex border border-secondary-1 text-sm rounded-full cursor-pointer">{{ $skill->name }}</a>
                            @endforeach
                        </div>
                    @endif
                    <a href="{{ route('works.show', $work) }}" class="inline-block px-8 py-3 rounded-full border border-primary-1 text-head-color font-medium hover:bg-primary-1 hover:text-white">View Work</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
