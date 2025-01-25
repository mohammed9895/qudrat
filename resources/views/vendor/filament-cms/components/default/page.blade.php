@props(['layout' => []])
@php
    use SolutionForest\FilamentCms\Facades\FilamentCms;

    $layoutName = $layout['name'] ?? FilamentCms::getCurrentLayout();
    $layoutData = $layout['data'] ?? [];
@endphp

@extends($layoutName, $layoutData)

@section('content')
    <main {{ $attributes->class([
        '',
    ]) }}>
        {{ $slot }}
    </main>
@endsection
