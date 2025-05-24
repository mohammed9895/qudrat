<div>
    @if(isset($recommendation['error']))
        <p class="text-red-500">{{ $recommendation['error'] }}</p>
    @else
        <p class="mb-2">{{ $recommendation['suggestion'] ?? __('general.ai.no_suggestion') }}</p>
        @if(!empty($recommendation['recommended_additions']))
            <div class="flex flex-col items-start gap-2 mb-2">
                @foreach($recommendation['recommended_additions'] as $item)
                    <x-filament::badge color="danger" size="xl" class="text" icon="hugeicons-graduation-scroll">
                        {{ $item }}
                    </x-filament::badge>
                @endforeach
            </div>
        @endif

        {{--        <p class="mt-2 text-sm text-gray-500">--}}
        {{--            {{ __('general.ai.score') }}: {{ $recommendation['score'] ?? '-' }}--}}
        {{--        </p>--}}
    @endif
</div>
