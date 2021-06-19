@extends('template.structured', ['title' => 'Update Computer'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header')
        <div class="w-full max-w-3xl rounded container mx-auto mt-4 p-3 bg-white shadow-md">
            <div>
                <span class="font-bold text-xl">Update Computer</span>
            </div>
            <form class="mt-4" action="{{ route('admin.computers.update', ['computer' => $computer]) }}" method="POST">
                @csrf
                @method('PATCH')

                <div>
                    <input type="hidden" name="room" value="{{ $computer->room->id }}">
                </div>
                <div>
                    <label class="font-bold block text-gray-700 my-2" for="hostname">
                        Hostname
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('hostname') border-red-500 @enderror focus:outline-none focus:ring" id="hostname" name="hostname" type="text" placeholder="Hostname" value="{{ old('hostname') ?? $computer->hostname }}">
                    @error('hostname')
                    <span class="text-red-500">{{ $errors->first('hostname') }}</span>
                    @enderror
                </div>
                <div>
                    <label class="font-bold block text-gray-700 my-2" for="ip-address">
                        IP Address
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('ip_address') border-red-500 @enderror focus:outline-none focus:ring" id="ip-address" name="ip_address" type="text" placeholder="IP Address" value="{{ old('ip_address') ?? $computer->ip_address }}">
                    @error('ip_address')
                        <span class="text-red-500">{{ $errors->first('ip_address') }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <button class="btn bg-green-500 p-2 text-white rounded hover:bg-green-700" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
