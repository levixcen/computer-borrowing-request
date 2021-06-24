@extends('template.center-structured', ['title' => 'Home'])

@section('contents')
    <div class="bg-white w-full max-w-4xl m-auto p-4 flex flex-col items-center rounded sm:flex-row">
        @include('components.user-navigation', ['title' => 'Home'])
        <div class="flex-1 p-2 sm:border-l-2">
            @unless ($schedules->count() == 0)
                @foreach ($schedules as $schedule)
                    <div class="w-full p-4 flex cursor-pointer items-center hover:bg-gray-300">
                        <a href="{{ route('schedules.show', ['schedule' => $schedule]) }}">
                            <div class="pr-4">
                                <x-heroicon-s-desktop-computer />
                            </div>
                            <div class="flex-1">
                                <div class="font-bold">
                                    {{ $schedule->description }}
                                </div>
                                <div class="hidden sm:block">
                                    Room {{ $schedule->room->name ?? '' }}
                                </div>
                                <div class="hidden sm:block">
                                    {{ $schedule->start_datetime }} - {{ $schedule->end_datetime }}
                                </div>
                            </div>
                            <div>
                                &gt;
                            </div>
                        </a>
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
