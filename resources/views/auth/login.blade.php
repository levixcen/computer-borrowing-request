@extends('template.center-structured', ['title' => 'Login'])

@section('contents')
    <div class="bg-white w-full max-w-md m-auto p-8 shadow-md rounded">
        <div class="my-4 text-center">
            <h2 class="text-2xl font-bold">@lang('auth.labels.login')</h2>
        </div>
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf

            <div class="mt-3">
                <label class="font-bold block text-gray-700 my-2" for="email">
                    @lang('auth.labels.email')
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('email') border-red-500 @enderror focus:outline-none focus:ring" id="email" name="email" type="email" placeholder="@lang('auth.placeholders.email')" value="{{ old('email') ?? '' }}">
                @error('email')
                    <span class="text-red-500">{{ $errors->first('email') }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="font-bold block text-gray-700 my-2" for="password">
                    @lang('auth.labels.password')
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight @error('password') border-red-500 @enderror focus:outline-none focus:ring" id="password" name="password" type="password" placeholder="@lang('auth.placeholders.password')">
                @error('password')
                    <span class="text-red-500">{{ $errors->first('password') }}</span>
                @enderror
            </div>
            <div class="mt-2 mb-3 flex items-center space-x-3">
                <input class="rounded h-4 w-4 border border-gray-300 shadow focus:outline-none" type="checkbox" name="remember_me" id="remember-me">
                <label class="text-gray-900" for="remember-me">@lang('auth.labels.remember_me')</label>
            </div>
            <div class="mt-4 flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring">@lang('auth.labels.login')</button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('auth.form.register') }}">
                    @lang('auth.links.register')
                </a>
            </div>
            <div class="mt-3 text-red-500">
                @error('credential')
                    {{ $errors->first('credential') }}
                @enderror
            </div>
        </form>
    </div>
@endsection
