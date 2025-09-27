<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @livewireStyles

    @include('static.core_css')


    <script data-navigate-once="" src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>

    <script data-navigate-once src="{{ asset('js/app.js') }}"></script>

</head>

<body>

    {{ $slot }}

    @livewireScripts

    @include('static.core_js')

</body>

</html>