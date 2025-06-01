<div>
    <!-- Banner -->
    <div class="bg-brand-blue/30 pt-[160px] pb-28">
        <div class="container">
            <div class="flex items-center justify-between gap-4 flex-wrap md:flex-nowrap">
                <div class="w-full md:w-6/12">
                    <x-breadcrumbs/>
                    <h2 class="text-4xl sm:text-5xl font-semibold mb-3">{{ __('general.search-result-for', ['query' => $search]) }}</h2>
                </div>
                <div class="w-6/12">
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->
    <div class="container py-24">
        @php
            use Illuminate\Support\Collection;$hasSearchType = !empty($searchType);
        @endphp

        @if ($hasSearchType && $results instanceof Collection)
            {{-- ✅ Specific type selected --}}
            <div class="mb-14">
                <h3 class="text-2xl font-semibold mb-6">
                    {{ __('general.navigation.' . $searchType) }}
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($results as $item)
                        @include('partials.search-card', ['type' => $searchType, 'item' => $item])
                    @endforeach
                </div>
            </div>

        @elseif (is_array($results) && count($results))
            {{-- ✅ No specific type selected — grouped view --}}
            @foreach ($results as $type => $items)
                @if ($items->count())
                    <div class="mb-14">
                        <h3 class="text-2xl font-semibold mb-6">
                            {{ __('general.navigation.' . $type) }}
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach ($items as $item)
                                @include('partials.search-card', ['type' => $type, 'item' => $item])
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

        @else
            {{-- ❌ No results --}}
            <div class="text-center py-16 text-gray-500">
                {{ __('general.no-results') }}
            </div>
        @endif
    </div>

</div>
