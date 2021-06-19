@extends('template.structured', ['title' => 'Admin Home Page'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header')
        <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md">
            Home
        </div>
    </div>
@endsection
