@extends('template.structured', ['title' => 'Rooms Management'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header', ['current' => 'Rooms'])
        <div>
            Room
        </div>
    </div>
@endsection
