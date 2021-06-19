@extends('template.structured', ['title' => 'Borrowing Request'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header')
        <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md">
            <div>
                <span class="font-bold text-xl">Borrowing Request Management</span>
            </div>
            <table class="w-full border mt-4 shadow-md">
                <thead>
                <tr>
                    <th class="p-2">Requested At</th>
                    <th class="p-2">Email Requestor</th>
                    <th class="p-2">Status</th>
                    <th class="w-36 p-2">Action</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @foreach ($borrowingRequests as $borrowingRequest)
                    <tr class="bg-gray-200">
                        <td>{{ $borrowingRequest->created_at }}</td>
                        <td>{{ $borrowingRequest->user->email }}</td>
                        <td>{{ $borrowingRequest->status ?? 'Waiting for Approval' }}</td>
                        <th class="flex items-center justify-center">
                            <a class="mx-2 text-blue-500 hover:text-blue-700" href="{{ route('admin.borrowing-requests.show', ['borrowing_request' => $borrowingRequest]) }}">
                                <x-heroicon-s-clipboard-list style="width: 25px;" />
                            </a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $borrowingRequests->links() }}
        </div>
    </div>
@endsection
