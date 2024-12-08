<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ __('Qudrat') }} | {{ $title ?? 'Page Title' }}</title>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">

        <link href="https://fonts.cdnfonts.com/css/caros-soft" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

        @vite('resources/css/app.css')
    </head>
    <body>
    <x-partials.nav />

        {{ $slot }}

   <x-partials.footer />

        <script src="{{ asset('assets/js/plugins.min.js') }}"></script>
        <script src="{{ asset('assets/js/flowbite.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
    </body>
</html>
