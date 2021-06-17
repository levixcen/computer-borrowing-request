@extends('template.center-structured', ['title' => 'Register'])

@section('contents')
    <div class="bg-white w-full max-w-md m-auto p-8 shadow-md rounded">
        <div class="my-4 text-center">
            <h2 class="text-2xl font-bold">@lang('auth.labels.register')</h2>
        </div>
        <form action="{{ route('auth.register') }}" method="POST">
            @csrf

            <div class="my-4">
                <label class="font-bold block text-gray-700 my-2" for="name">
                    @lang('auth.labels.name')
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('name') border-red-500 @enderror focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="@lang('auth.placeholders.name')" value="{{ old('name') ?? '' }}">
                @error('name')
                    <span class="text-red-500">{{ $errors->first('name') }}</span>
                @enderror
            </div>
            <div class="my-4">
                <label class="font-bold block text-gray-700 my-2" for="email">
                    @lang('auth.labels.email')
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('email') border-red-500 @enderror focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="@lang('auth.placeholders.email')" value="{{ old('email') ?? '' }}">
                @error('email')
                    <span class="text-red-500">{{ $errors->first('email') }}</span>
                @enderror
            </div>
            <div class="my-4">
                <label class="font-bold block text-gray-700 my-2" for="password">
                    @lang('auth.labels.password')
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight @error('password') border-red-500 @enderror focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="@lang('auth.placeholders.password')">
                @error('password')
                    <span class="text-red-500">{{ $errors->first('password') }}</span>
                @enderror
            </div>
            <div class="my-4">
                <label class="font-bold block text-gray-700 my-2" for="password-confirmation">
                    @lang('auth.labels.password_confirmation')
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight @error('password') border-red-500 @enderror focus:outline-none focus:shadow-outline" id="password-confirmation" name="password_confirmation" type="password" placeholder="@lang('auth.placeholders.password_confirmation')">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">@lang('auth.labels.register')</button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('auth.form.login') }}">
                    @lang('auth.links.login')
                </a>
            </div>
        </form>
    </div>
@endsection
