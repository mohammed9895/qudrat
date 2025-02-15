@php
    use SolutionForest\FilamentCms\Facades\FilamentCms;use SolutionForest\FilamentCms\SEO\Support\SEOData;

    /** @var ?SEOData $seo */

    $theme = FilamentCms::getCurrentTheme();
@endphp
    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}" class="scroll-smooth">
<head>
    @if ($seo)
        {!! seo($seo) !!}
    @endif
    @stack('beforeCoreStyles')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    <title>{{ __('Qudrat') }} | {{ $title ?? 'Page Title' }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />


    @vite(['resources/css/app.css', 'resources/js/app.js'], 'build')
    @stack('styles')
</head>

<body style='font-family: "IBM Plex Sans Arabic", serif !important;'>
@section('header')
    @include("cms.theme.{$theme}.header")
@show



@yield('content')

@section('footer')
    @include("cms.theme.{$theme}.footer")
@show

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
<script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datamaps/0.5.9/datamaps.world.min.js"
        integrity="sha512-ShMIwoBgGctXjiRZubJipPPimOnfP7JgsipylJsQ0mlQaHltZJM5MK4u/7QaBd2bWwDDQ93eDdorzUBC3PJBOA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/js/preline.js') }}"></script>
<script>
    // Map
    (function () {
        const dataSet = {
            BRA: {
                active: {
                    value: '5,101',
                    percent: '42.2',
                    isGrown: false
                },
                new: {
                    value: '444',
                    percent: '41.2',
                    isGrown: false
                },
                fillKey: 'MAJOR',
                short: 'br'
            },
            CHN: {
                active: {
                    value: '10,101',
                    percent: '13.7',
                    isGrown: true
                },
                new: {
                    value: '509',
                    percent: '0.1',
                    isGrown: false
                },
                fillKey: 'MAJOR',
                short: 'cn'
            },
            DEU: {
                active: {
                    value: '8,408',
                    percent: '5.4',
                    isGrown: false
                },
                new: {
                    value: '1001',
                    percent: '5.1',
                    isGrown: true
                },
                fillKey: 'MAJOR',
                short: 'de'
            },
            GBR: {
                active: {
                    value: '4,889',
                    percent: '9.1',
                    isGrown: false
                },
                new: {
                    value: '2,001',
                    percent: '3.2',
                    isGrown: true
                },
                fillKey: 'MAJOR',
                short: 'gb'
            },
            IND: {
                active: {
                    value: '1,408',
                    percent: '19.2',
                    isGrown: true
                },
                new: {
                    value: '392',
                    percent: '11.1',
                    isGrown: true
                },
                fillKey: 'MAJOR',
                short: 'in'
            },
            USA: {
                active: {
                    value: '392',
                    percent: '0.9',
                    isGrown: true
                },
                new: {
                    value: '1,408',
                    percent: '2.2',
                    isGrown: true
                },
                fillKey: 'MAJOR',
                short: 'us',
                customName: 'United States'
            }
        };
        const dataMap = new Datamap({
            element: document.querySelector('#container-s'),
            projection: 'mercator',
            responsive: true,
            fills: {
                defaultFill: '#8284c7',
                MAJOR: '#8284c7'
            },
            data: dataSet,
            geographyConfig: {
                borderColor: 'rgba(0, 0, 0, .09)',
                highlightFillColor: '#3cc7bc',
                highlightBorderColor: '#3cc7bc',
                popupTemplate: function (geo, data) {
                    const growUp = `<svg class="size-4 text-teal-500 dark:text-teal-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
          </svg>`;
                    const growDown = `<svg class="size-4 text-red-500 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/><polyline points="16 17 22 17 22 11"/></svg>
          </svg>`;

                    return `<div class="bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] w-[150px] p-3">
            <div class="flex mb-1">
              <div class="me-2">
                <div class="size-4 rounded-full bg-no-repeat bg-center bg-cover" style="background-image: url('/assets/images/flag-icons-main/${data.short}.svg')"></div>
              </div>
              <span class="text-sm font-medium">${data.customName || geo.properties.name}</span>
            </div>
            <div class="flex items-center">
              <span class="text-sm text-gray-500 dark:text-neutral-500">Talent:</span>
               <span class="text-sm font-medium ${data.active.value}</span>
               <span class="text-sm ${data.active.isGrown ? 'text-teal-500 dark:text-teal-400' : 'text-red-500 dark:text-red-400'}'>${data.active.percent}</span>
            </div>
            <div class="flex items-center">
              <span class="text-sm text-gray-500 dark:text-neutral-500">Expert:</span>
               <span class="text-sm font-medium ${data.new.value}</span>
               <span class="text-sm ${data.active.isGrown ? 'text-teal-500 dark:text-teal-400' : 'text-red-500 dark:text-red-400'}'>${data.new.percent}</span>
            </div>
          </div>`;
                }
            }
        });
        dataMap.addPlugin('update', function (_, mode) {
            this.options.fills = (mode === 'dark') ? {
                defaultFill: '#8284c7',
                MAJOR: '#8284c7'
            } : {
                defaultFill: '#8284c7',
                MAJOR: '#2e3192'
            };

            this.updateChoropleth(dataSet, {reset: true});
        });

        dataMap.update(localStorage.getItem('hs_theme'));

        window.addEventListener('on-hs-appearance-change', (evt) => {
            dataMap.update(evt.detail);
        });

        window.addEventListener('resize', function () {
            dataMap.resize();
        });
    })();
</script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        effect: "cards",
        grabCursor: true,
    });
</script>

@stack('beforeCoreScripts')
@stack('scripts')
</body>
</html>
