@extends('template.base')

@section('body')
    <div class="flex h-screen justify-center items-center">
        <div class="w-full max-w-6xl m-auto">
            @yield('contents')
        </div>
    </div>
@endsection
