@extends('template.structured', ['title' => 'Room Management'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header', ['current' => 'Rooms'])
        <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md">
            <div>
                <span class="font-bold text-xl mr-2">Room Management</span>
                <a class="btn bg-green-500 text-white p-2 rounded hover:bg-green-700" href="{{ route('admin.rooms.create') }}">
                    <x-heroicon-s-plus style="width: 20px; display: inline-block" /> Add New Room
                </a>
            </div>
            <table class="w-full border mt-4 shadow-md">
                <thead>
                    <tr>
                        <th class="p-2">Name</th>
                        <th class="p-2">Computers</th>
                        <th class="w-36 p-2">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($rooms as $room)
                        <tr class="bg-gray-200">
                            <td class="p-2">{{ $room->name }}</td>
                            <td class="p-2">{{ $room->computers()->count() }}</td>
                            <th class="p-2 flex items-center justify-center">
                                <a class="mx-2 text-blue-500 hover:text-blue-700" href="{{ route('admin.rooms.edit', ['room' => $room]) }}">
                                    <x-heroicon-s-pencil style="width: 25px;" />
                                </a>
                                <a class="mx-2 text-red-500 hover:text-red-700" href="{{ route('admin.rooms.destroy', ['room' => $room]) }}" data-method="DELETE" data-form-_token="{{ csrf_token() }}">
                                    <x-heroicon-s-trash style="width: 25px;" />
                                </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rooms->links() }}
        </div>
    </div>
@endsection
