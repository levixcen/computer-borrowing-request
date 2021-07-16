<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Christopher Limawan">
    <meta name="description" content="Computer Borrowing Request">
    <meta name="keyword" content="Computer Borrowing,Computer Remote Request">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@unless(empty($title)) {{ $title . ' - ' }} @endunless{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="default-color-theme">
    @yield('body')
</body>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</html>
