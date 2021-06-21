@extends('template.center-structured', ['title' => 'Borrowing Request'])

@section('contents')
    <div class="bg-white w-full max-w-4xl m-auto p-4 flex flex-col items-center rounded sm:flex-row">
        @include('components.user-navigation', ['title' => 'Borrowing Requests'])
        <div class="flex-1 p-2 sm:border-l-2">
            <div class="text-right mb-2">
                <a href="{{ route('borrowing-requests.create') }}">
                    <button class="btn bg-green-500 text-white rounded px-2 hover:bg-green-700">
                        <x-heroicon-s-plus style="width: 20px; display: inline-block" /> New Request
                    </button>
                </a>
            </div>
            <table class="table-auto border w-full">
                <thead>
                    <tr>
                        <th class="p-2">Request Date</th>
                        <th class="w-48 p-2">Reason</th>
                        <th class="p-2">Start Time</th>
                        <th class="p-2">End Time</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrowingRequests as $borrowingRequest)
                        <tr class="bg-gray-200 cursor-pointer hover:bg-gray-100">
                            <td class="p-2">{{ $borrowingRequest->created_at->format('d M Y H:i') }}</td>
                            <td class="p-2">{{ $borrowingRequest->reason }}</td>
                            <td class="p-2">{{ $borrowingRequest->start_datetime->format('d M Y H:i') }}</td>
                            <td class="p-2">{{ $borrowingRequest->end_datetime->format('d M Y H:i') }}</td>
                            <td class="p-2">{{ $borrowingRequest->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
