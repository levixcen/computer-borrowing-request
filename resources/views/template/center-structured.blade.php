@extends('template.base')

@push('styles')
    <style>
        .h-9\.2\/10 {
            height: 92%;
        }
    </style>
@endpush

@section('body')
    <div class="flex h-9.2/10 justify-center items-center z-20 relative">
        <div class="w-full max-w-6xl m-auto">
            @yield('contents')
        </div>
    </div>
    <div class="text-center text-gray-500 z-10 relative">
        <div>
            Copyright @ {{ now()->format('Y') }} Christopher Limawan
        </div>
        <div>
            https://codepository.org
        </div>
    </div>
@endsection
