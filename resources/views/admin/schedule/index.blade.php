@extends('template.structured', ['title' => 'Schedule Management'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header')
        <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md" id="filter-container">
            <div class="flex flex-row">
                <span class="font-bold text-xl">Filter</span>
            </div>
            <form action="{{ route('admin.schedules.index') }}">
                <div>
                    <label class="font-bold block text-gray-700 my-2" for="description">
                        Description
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" id="description" name="description" type="text" placeholder="Description" value="{{ request()->has('description') ? request()->get('description') : (old('description') ?? '') }}">
                </div>
                <div>
                    <label class="font-bold block text-gray-700 my-2" for="room">
                        Room
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" name="room" id="room">
                        <option value="">-- Choose One --</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" @if((request()->has('room') ? request()->get('room') : (old('room') ?? '')) === $room->id) selected @endif>{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <div class="flex-1 mr-1">
                        <label class="font-bold block text-gray-700 my-2" for="start-date">
                            Start Date
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" id="start-date" name="start_date" type="date" placeholder="Start Date" value="{{ request()->has('start_date') ? request()->get('start_date') : (old('start_date') ?? '') }}">
                    </div>
                    <div class="flex-1 ml-1">
                        <label class="font-bold block text-gray-700 my-2" for="end-date">
                            End Date
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" id="end-date" name="end_date" type="date" placeholder="End Date" value="{{ request()->has('end_date') ? request()->get('end_date') : (old('end_date') ?? '') }}">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn bg-blue-500 text-white rounded mt-4 mr-2 p-2 hover:bg-blue-700">
                        Filter
                    </button>
                    <a href="{{ route('admin.schedules.index') }}" class="ml-2 text-blue-500 underline hover:text-blue-700">
                        Reset
                    </a>
                </div>
            </form>
        </div>
        <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md">
            <div class="flex flex-row">
                <div class="flex-1">
                    <span class="font-bold text-xl">Schedule Management</span>
                </div>
                <div>
                    <button class="btn bg-blue-500 rounded px-2 py-1 text-white hover:bg-blue-700" id="btn-filter">
                        Filter
                    </button>
                </div>
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
                            <a class="mx-2 text-red-500 hover:text-red-700" href="{{ route('admin.schedules.destroy', ['schedule' => $schedule]) }}">
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

@push('scripts')
    <script>
        let filterState = false;

        const changeFilterContainerState = () => {
            if (filterState) {
                document.getElementById('filter-container').classList.remove('hidden');
            } else {
                document.getElementById('filter-container').classList.add('hidden');
            }
        };

        const onFilterClicked = () => {
            filterState = !filterState;
            changeFilterContainerState();
        };

        const onDocumentReady = () => {
            changeFilterContainerState();
            document.getElementById('btn-filter').onclick = onFilterClicked;
        };

        document.addEventListener('DOMContentLoaded', onDocumentReady);
    </script>
@endpush
