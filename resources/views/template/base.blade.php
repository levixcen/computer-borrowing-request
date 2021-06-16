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
    <title>@if(empty($title)) {{ $title . ' - ' }} @endif{{ config('app.name') }}</title>
    @stack('styles')
</head>
<body>
    @yield('body')
</body>
@stack('scripts')
</html>
