<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    <title>{{ __('Qudrat') }} | @yield('title', 'Page Title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="https://fonts.cdnfonts.com/css/caros-soft" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    @vite(['resources/css/app.css', 'resources/js/app.js'], 'build')
</head>
<body>
<x-partials.nav/>

{{ $slot }}

<x-partials.footer/>

@livewire('notifications')


<script src="{{ asset('assets/js/plugins.min.js') }}"></script>
<script src="{{ asset('assets/js/flowbite.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    // Age range
    $(document).ready(function () {
        const rangeInput = $('.filter_age .range_input .input')
        const progress = $('.filter_age .tow_bar_block .progress')
        const minAge = $('.filter_age .age_min')
        const maxAge = $('.filter_age .age_max')
        let ageGap = 5

        rangeInput.on('input', function () {
            let minValue = parseInt(rangeInput.eq(0).val())
            let maxValue = parseInt(rangeInput.eq(1).val())

            if (maxValue - minValue <= ageGap) {
                if ($(this).hasClass('range_min')) {
                    rangeInput.eq(0).val(maxValue - ageGap)
                    minValue = maxValue - ageGap
                } else {
                    rangeInput.eq(1).val(minValue + ageGap)
                    maxValue = minValue + ageGap
                }
            } else {
                progress.css({
                    'left': (minValue / rangeInput.eq(0).attr('max')) * 100 + "%",
                    'right': 100 - (maxValue / rangeInput.eq(1).attr('max')) * 100 + "%"
                });
            }

            minAge.text(minValue)
            maxAge.text(maxValue)
        });
    });
</script>
</body>
</html>
