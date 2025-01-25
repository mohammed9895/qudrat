@props(['layout', 'page' => null])
@php
    use SolutionForest\FilamentCms\Facades\FilamentCms;

    /** @var array $layout */
    /** @var ?\SolutionForest\FilamentCms\Dto\CmsPageData $page */
    $content = data_get($page?->data, 'content', null);

    $theme = FilamentCms::getCurrentTheme();
@endphp

<x-dynamic-component
    component="filament-cms::{{$theme}}.page"
    :layout="$layout">
    @if ($page->tags->isNotEmpty())
        <div class="flex gap-2">
            @foreach ($page->tags as $tag)
                <span data-slug="{{$tag->slug ?? null}}" class="bg-black font-body inline-block mb-5 px-2 py-1 rounded-full sm:mb-8 text-sm text-white">
                    {{ $tag->title }}
                </span>
            @endforeach
        </div>
    @endif
    @if ($content)
        {!! $content !!}
    @endif
</x-dynamic-component>
