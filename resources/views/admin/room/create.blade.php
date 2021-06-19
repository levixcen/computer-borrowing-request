@extends('template.structured', ['title' => 'Create Room'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header')
        <div class="w-full max-w-3xl rounded container mx-auto mt-4 p-3 bg-white shadow-md">
            <div>
                <span class="font-bold text-xl">Create New Room</span>
            </div>
            <form class="mt-4" action="">
                <div>
                    <input type="text" name="" id="">
                </div>
            </form>
        </div>
    </div>
@endsection
