@extends('template.center-structured', ['title' => 'Verify E-mail'])

@section('contents')
    <div class="bg-white w-full max-w-md m-auto p-8 shadow-md rounded">
        <div class="my-4 text-center">
            <h2 class="text-2xl font-bold">Email Verification</h2>
        </div>
        <div>
            Success register data. Please check your email to verify your account.
            @if (Auth::check())
                <br />
                <a class="text-blue-500 underline hover:text-blue-700" href="{{ route('auth.verification.send') }}" data-method="POST" data-form-_token="{{ csrf_token() }}">Resend verification email</a>
            @endif
            <br />
            <a class="text-blue-500 underline hover:text-blue-700" href="{{ route('auth.form.login') }}">Back to login</a>
            @if (Auth::check())
                <br />
                <a class="text-blue-500 underline hover:text-blue-700" href="{{ route('auth.logout') }}" data-method="POST" data-form-_token="{{ csrf_token() }}">Logout</a>
            @endif
        </div>
    </div>
@endsection
