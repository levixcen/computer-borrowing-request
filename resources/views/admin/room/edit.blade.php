@extends('template.structured', ['title' => 'Update Room'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header')
        <div class="w-full max-w-3xl rounded container mx-auto mt-4 p-3 bg-white shadow-md">
            <div>
                <span class="font-bold text-xl">Update Room</span>
            </div>
            <form class="mt-4" action="{{ route('admin.rooms.update', ['room' => $room]) }}" method="POST">
                @csrf
                @method('PATCH')

                <div>
                    <label class="font-bold block text-gray-700 my-2" for="room-type">
                        Room Type
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('room_type') border-red-500 @enderror focus:outline-none focus:ring" name="room_type" id="room-type">
                        <option value="">-- Choose One --</option>
                        @foreach($roomTypes as $roomType)
                            <option value="{{ $roomType->id }}" @if((old('room_type') ?? $room->roomType->id) === $roomType->id) selected @endif>{{ $roomType->name }}</option>
                        @endforeach
                    </select>
                    @error('room_type')
                        <span class="text-red-500">{{ $errors->first('room_type') }}</span>
                    @enderror
                </div>
                <div>
                    <label class="font-bold block text-gray-700 my-2" for="name">
                        Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('name') border-red-500 @enderror focus:outline-none focus:ring" id="name" name="name" type="text" placeholder="Room Name" value="{{ old('name') ?? $room->name }}">
                    @error('name')
                        <span class="text-red-500">{{ $errors->first('name') }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <button class="btn bg-green-500 p-2 text-white rounded hover:bg-green-700" type="submit">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
