@extends('template.center-structured', ['title' => 'Login'])

@section('contents')
    <div class="bg-white w-full max-w-md m-auto p-8 shadow-md rounded">
        <div class="my-4 text-center">
            <h2 class="text-2xl font-bold">Login</h2>
        </div>
        <form action="">
            <div class="my-4">
                <label class="font-bold block text-gray-700 my-2" for="email">
                    E-mail Address
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="E-mail Address">
            </div>
            <div class="my-4">
                <label class="font-bold block text-gray-700 my-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    Don't have an account? Register here.
                </a>
            </div>
        </form>
    </div>
@endsection
