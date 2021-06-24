@extends('template.structured', ['title' => 'Borrowing Request Detail'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header')
        <div class="container w-full max-w-3xl mx-auto mt-4 flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>Please block the blue area beside password to get the computer's current password.</p>
        </div>
        <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md">
            <div>
                <span class="font-bold text-xl">Schedule - {{ $schedule->id }}</span>
            </div>
            <div class="mt-4">
                <div>
                    Request Creator Email: {{ $schedule->user->email ?? '' }}
                </div>
                <div>
                    Request At: {{ $schedule->borrowingRequest->created_at->format('d M Y H:i') }}
                </div>
                <div>
                    Start Time: {{ $schedule->start_datetime->format('d M Y H:i') }}
                </div>
                <div>
                    End Time: {{ $schedule->end_datetime->format('d M Y H:i') }}
                </div>
            </div>
        </div>
        <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md">
            <div>
                <span class="font-bold text-xl">Computer Information</span>
            </div>
            <div class="mt-4">
                <div>
                    Room: {{ $schedule->room->name ?? '' }}
                </div>
                <div>
                    Computer: {{ $schedule->computer->hostname ?? '' }} - {{ $schedule->computer->ip_address ?? '' }}
                </div>
                <div>
                    Username: {{ $schedule->username }}
                </div>
                <div>
                    Password: <span class="text-blue-500 bg-blue-500">{{ $schedule->password }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
