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
                    <tr class="bg-gray-200 cursor-pointer hover:bg-gray-100">
                        <td class="p-2">2021-08-02</td>
                        <td class="p-2">Begitu</td>
                        <td class="p-2">2021-08-02 14:00</td>
                        <td class="p-2">2021-08-02 15:00</td>
                        <td class="p-2">Accepted</td>
                    </tr>
                    <tr class="bg-gray-200 cursor-pointer hover:bg-gray-100">
                        <td class="p-2">2021-08-02</td>
                        <td class="p-2">Begitu</td>
                        <td class="p-2">2021-08-02 14:00</td>
                        <td class="p-2">2021-08-02 15:00</td>
                        <td class="p-2">Rejected</td>
                    </tr>
                    <tr class="bg-gray-200 cursor-pointer hover:bg-gray-100">
                        <td class="p-2">2021-08-02</td>
                        <td class="p-2">Begitu</td>
                        <td class="p-2">2021-08-02 14:00</td>
                        <td class="p-2">2021-08-02 15:00</td>
                        <td class="p-2">Accepted</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
