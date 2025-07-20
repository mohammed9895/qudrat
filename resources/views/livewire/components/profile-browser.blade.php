<div class="py-24">
    <div class="container">
        <div class="grid grid-cols-12 gap-5">
            <!-- Sidebar Filter -->
            <div class="col-span-full md:col-span-4 xl:col-span-3">
                <div class="bg-white p-6 rounded-xl">
                    {{ $this->form }}
                </div>
            </div>

            <!-- Profile Grid -->
            <div class="col-span-full xl:col-span-9">
                <div class="flex justify-end mb-4 space-x-3 rtl:space-x-reverse">
                    <button wire:click="$set('viewMode', 'grid')"
                            class="text-sm px-4 py-2 border rounded {{ $viewMode === 'grid' ? 'bg-primary-1 text-white' : 'bg-white' }}">
                        <x-hugeicons-grid-table/>
                    </button>
                    <button wire:click="$set('viewMode', 'list')"
                            class="text-sm px-4 py-2 border rounded {{ $viewMode === 'list' ? 'bg-primary-1 text-white' : 'bg-white' }}">
                        <x-hugeicons-list-view/>
                    </button>
                </div>
                <div class="{{ $viewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-3 gap-10' : 'space-y-6' }}">
                    @forelse($this->profiles as $talent)
                        <div
                            class="{{ $viewMode === 'grid' ? 'bg-white border-2 border-gray-100 rounded-xl p-6' : 'bg-white border rounded-xl p-6 w-full flex flex-col md:flex-row gap-6 items-center' }}">
                            @if($viewMode === 'grid')
                                {{-- Grid layout --}}
                                <div class="flex flex-col justify-center items-center w-full">
                                    <div class="relative inline-block mb-4">
                                        <div class="size-24 rounded-full"
                                             style="background: url('{{ $talent->getThumbnailImage() }}'); background-size: cover; background-position: center;"></div>
                                    </div>
                                    <h4 class="text-xl font-medium mb-1">{{ $talent->fullname }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ $talent->position }}</p>

                                    @if($talent->skills()->count())
                                        <div class="flex flex-wrap justify-center gap-2 mb-4">
                                            @foreach($talent->skills()->get() as $skill)
                                                <span
                                                    class="px-3 py-1 text-xs bg-gray-100 rounded-full">{{ $skill->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <a href="{{ route('profile.index', $talent) }}"
                                       class="inline-block mt-auto px-6 py-2 rounded-full border border-primary-1 text-primary-1 font-medium hover:bg-primary-1 hover:text-white">
                                        {{ __('general.view-profile') }}
                                    </a>
                                </div>
                            @else
                                {{-- List layout --}}
                                <div class="flex-shrink-0">
                                    <div class="size-24 rounded-full"
                                         style="background: url('{{ $talent->getThumbnailImage() }}'); background-size: cover; background-position: center;"></div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-xl font-medium mb-1">{{ $talent->fullname }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ $talent->position }}</p>

                                    @if($talent->skills()->count())
                                        <div class="flex flex-wrap gap-2 mb-2">
                                            @foreach($talent->skills()->get() as $skill)
                                                <span
                                                    class="px-3 py-1 text-xs bg-gray-100 rounded-full">{{ $skill->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <a href="{{ route('profile.index', $talent) }}"
                                       class="inline-block px-6 py-2 rounded-full border border-primary-1 text-primary-1 font-medium hover:bg-primary-1 hover:text-white">
                                        {{ __('general.view-profile') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500">{{ __('No profiles found.') }}</p>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $this->profiles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
