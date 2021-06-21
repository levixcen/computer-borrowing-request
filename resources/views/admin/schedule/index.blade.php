@extends('template.structured', ['title' => 'Schedule Management'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header')
        <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md">
            <div>
                <span class="font-bold text-xl">Schedule Management</span>
            </div>
            <table class="w-full border mt-4 shadow-md">
                <thead>
                <tr>
                    <th class="p-2">Description</th>
                    <th class="p-2">Start Time</th>
                    <th class="p-2">End Time</th>
                    <th class="w-36 p-2">Action</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @foreach ($schedules as $schedule)
                    <tr class="bg-gray-200">
                        <td>{{ $schedule->description }}</td>
                        <td>{{ $schedule->start_datetime->format('d M Y H:i') }}</td>
                        <td>{{ $schedule->end_datetime->format('d M Y H:i') }}</td>
                        <th class="flex items-center justify-center">
                            <a class="mx-2 text-blue-500 hover:text-blue-700" href="{{ route('admin.schedules.show', ['schedule' => $schedule]) }}">
                                <x-heroicon-s-clipboard-list style="width: 25px;" />
                            </a>
                            <a class="mx-2 text-red-500 hover:text-red-700" href="">
                                <x-heroicon-s-trash style="width: 25px;" />
                            </a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $schedules->links() }}
        </div>
    </div>
@endsection
