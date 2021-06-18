@extends('template.center-structured', ['title' => 'Home'])

@section('contents')
    <div class="bg-white w-full max-w-3xl m-auto p-4 flex flex-col items-center rounded sm:flex-row">
        <div class="w-64 p-2">
            <div class="text-lg font-medium mb-2">
                Good day,
                <br />
                {{ Auth::user()->name }}
            </div>
            <div class="text-sm">
                Here are your borrowing schedule for today:
            </div>
            <div class="mt-8 mr-6">
                <a class="border-gray-300 border-t-2 p-2 rounded hover:bg-blue-500 hover:text-white" href="{{ route('borrowing-requests.index') }}">
                    <button class="w-full appearance-none">
                        <x-heroicon-o-pencil-alt style="width: 20px; display: inline-block" /> Request Computer
                    </button>
                </a>
                <a class="border-gray-300 border-t-2 border-b-2 p-2 rounded hover:bg-blue-500 hover:text-white" href="{{ route('auth.logout') }}" data-method="POST" data-form-_token="{{ csrf_token() }}">
                    <button class="w-full appearance-none">
                        Logout
                    </button>
                </a>
            </div>
        </div>
        <div class="flex-1 p-2 sm:border-l-2">
            @unless ($schedules->count() == 0)
                @foreach ($schedules as $schedule)
                    <div class="w-full p-4 flex cursor-pointer items-center hover:bg-gray-300">
                        <div class="pr-4">
                            <x-heroicon-s-desktop-computer />
                        </div>
                        <div class="flex-1">
                            <div class="font-bold">
                                {{ $schedule->description }}
                            </div>
                            <div class="hidden sm:block">
                                Room {{ $schedule->room->name }}
                            </div>
                            <div class="hidden sm:block">
                                June 18, 2021 08:30-June 18, 2021, 10:30
                            </div>
                        </div>
                        <div>
                            &gt;
                        </div>
                    </div>
                @endforeach
            @else
                <div class="w-full p-4 items-center text-center text-gray-500">
                    No borrowing schedules available.
                </div>
            @endunless
        </div>
    </div>
@endsection
