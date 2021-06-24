@extends('template.center-structured', ['title' => 'Verify E-mail'])

@section('contents')
    <div class="bg-white w-full max-w-md m-auto p-8 shadow-md rounded">
        <div class="my-4 text-center">
            <h2 class="text-2xl font-bold">Email Verification</h2>
        </div>
        <div>
            Success verify your account.
            <br />
            <a class="text-blue-500 underline hover:text-blue-700" href="{{ route('home') }}">Back to home</a>
        </div>
    </div>
@endsection
