@extends('template.center-structured', ['title' => 'Borrowing Request'])

@section('contents')
    <div class="bg-white w-full max-w-4xl m-auto p-4 flex flex-col items-center rounded sm:flex-row">
        @include('component.user-navigation', ['title' => ''])
        <div class="flex-1 p-2 sm:border-l-2">
            <form class="p-4" action="{{ route('borrowing-requests.store') }}" method="POST">
                @csrf

                <div class="my-2">
                    <label class="font-bold block text-gray-700 my-2" for="date-use">
                        Date
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('date_use') border-red-500 @enderror focus:outline-none focus:ring" type="date" name="date_use" id="date-use">
                    @error('date_use')
                        <span class="text-red-500">{{ $errors->first('date_use') }}</span>
                    @enderror
                </div>
                <div class="flex flex-row my-2">
                    <div class="flex-1 mr-1">
                        <label class="font-bold block text-gray-700 my-2" for="start-time">
                            Start Time
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('start_time') border-red-500 @enderror focus:outline-none focus:ring" type="time" name="start_time" id="start-time">
                        @error('start_time')
                            <span class="text-red-500">{{ $errors->first('start_time') }}</span>
                        @enderror
                    </div>
                    <div class="flex-1 ml-1">
                        <label class="font-bold block text-gray-700 my-2" for="end-time">
                            End Time
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('end_time') border-red-500 @enderror focus:outline-none focus:ring" type="time" name="end_time" id="end-time">
                        @error('end_time')
                            <span class="text-red-500">{{ $errors->first('end_time') }}</span>
                        @enderror
                    </div>
                </div>
                <div class="my-2">
                    <label class="font-bold block text-gray-700 my-2" for="reason">
                        Reason
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('reason') border-red-500 @enderror focus:outline-none focus:ring" type="text" name="reason" id="reason">
                    @error('reason')
                        <span class="text-red-500">{{ $errors->first('reason') }}</span>
                    @enderror
                </div>
                <div class="mt-4 text-right">
                    <button class="btn bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                        Request
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
