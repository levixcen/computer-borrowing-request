@extends('template.structured', ['title' => 'Borrowing Request Detail'])

@section('contents')
    <div class="w-full">
        @include('components.admin-header')
        <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md">
            <div>
                <span class="font-bold text-xl">Borrowing Request - {{ $borrowingRequest->id }}</span>
            </div>
            <div class="mt-4">
                <div>
                    Request Creator Email: {{ $borrowingRequest->user->email ?? '' }}
                </div>
                <div>
                    Request At: {{ $borrowingRequest->created_at->format('d M Y H:i') }}
                </div>
                <div>
                    Start Time: {{ $borrowingRequest->start_datetime->format('d M Y H:i') }}
                </div>
                <div>
                    End Time: {{ $borrowingRequest->end_datetime->format('d M Y H:i') }}
                </div>
                <div>
                    Reason: {{ $borrowingRequest->reason }}
                </div>
                @unless ($borrowingRequest->status === 'Waiting for Approval')
                    <div>
                        Status: <span class="@if ($borrowingRequest->status === 'Approved')text-green-500 @else text-red-500 @endif">{{ $borrowingRequest->status }}</span>
                    </div>
                    <div>
                        Rejection Reason: {{ $borrowingRequest->rejection_reason ?? '-' }}
                    </div>
                @endunless
            </div>
        </div>
        @if ($borrowingRequest->status === 'Waiting for Approval')
            <div class="container w-full max-w-3xl bg-white rounded mx-auto mt-4 p-3 shadow-md">
                <div>
                    <span class="font-bold text-xl">Change Status</span>
                </div>
                <form class="mt-4" action="{{ route('admin.borrowing-requests.update', ['borrowing_request' => $borrowingRequest]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="font-bold block text-gray-700 my-2" for="status">
                            Status
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('status') border-red-500 @enderror focus:outline-none focus:ring" name="status" id="status">
                            <option value="">-- Choose One --</option>
                            <option value="Approved" @if ((old('status') ?? '') === 'Approved') selected @endif>Approve</option>
                            <option value="Rejected" @if ((old('status') ?? '') === 'Rejected') selected @endif>Reject</option>
                        </select>
                        @error('status')
                            <span class="text-red-500">{{ $errors->first('status') }}</span>
                        @enderror
                    </div>
                    <div id="computer-allocation-container">
                        <label class="font-bold block text-gray-700 my-2" for="computer-allocation">
                            Computer Allocation
                        </label>
                        <div>
                            <input type="radio" name="computer_allocation" id="computer-allocation-auto-allocate" value="Auto-allocate computer" @if ((old('computer_allocation') ?? '') === 'Auto-allocate computer') checked @endif>
                            <label for="computer-allocation-auto-allocate">Auto-allocate computer</label>
                        </div>
                        <div>
                            <input type="radio" name="computer_allocation" id="computer-allocation-manual-allocate" value="Allocate computer manually" @if ((old('computer_allocation') ?? '') === 'Allocate computer manually') checked @endif>
                            <label for="computer-allocation-manual-allocate">Allocate computer manually</label>
                        </div>
                        @error('computer_allocation')
                            <span class="text-red-500">{{ $errors->first('computer_allocation') }}</span>
                        @enderror
                    </div>
                    <div id="room-computer-container" class="flex flex-row">
                        <div class="flex-1 mr-2">
                            <label class="font-bold block text-gray-700 my-2" for="room">
                                Room
                            </label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('room') border-red-500 @enderror focus:outline-none focus:ring" name="room" id="room">
                                <option value="">-- Choose One --</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" @if ((old('room') ?? '') === $room->id) selected @endif>{{ $room->name }}</option>
                                @endforeach
                            </select>
                            @error('room')
                                <span class="text-red-500">{{ $errors->first('room') }}</span>
                            @enderror
                        </div>
                        <div class="flex-1 ml-2">
                            <label class="font-bold block text-gray-700 my-2" for="computer">
                                Computer
                            </label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('computer') border-red-500 @enderror focus:outline-none focus:ring" name="computer" id="computer">
                                <option value="">-- Choose One --</option>
                            </select>
                            <div id="computer-error-message-container">
                                @error('computer')
                                    <span class="text-red-500">{{ $errors->first('computer') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="rejection-reason-container">
                        <label class="font-bold block text-gray-700 my-2" for="rejection-reason">
                            Rejection Reason
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('rejection_reason') border-red-500 @enderror focus:outline-none focus:ring" id="rejection-reason" name="rejection_reason" type="text" placeholder="Rejection Reason" value="{{ old('rejection_reason') ?? '' }}">
                        @error('rejection_reason')
                            <span class="text-red-500">{{ $errors->first('rejection_reason') }}</span>
                        @enderror
                    </div>
                    @error('available_computer')
                        <span class="text-red-500">{{ $errors->first('available_computer') }}</span>
                    @enderror
                    <div class="mt-4">
                        <button class="btn bg-green-500 text-white p-2 hover:bg-green-700" type="submit">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        @endunless
    </div>
@endsection

@push('scripts')
    <script>
        let beginning = true;

        const changeRejectionReasonContainerState = (value) => {
            if (value === 'Rejected') {
                document.getElementById('rejection-reason-container').classList.remove('hidden');
            } else {
                document.getElementById('rejection-reason-container').classList.add('hidden');
            }
        };

        const changeComputerAllocationContainerState = (value) => {
            if (value === 'Approved') {
                document.getElementById('computer-allocation-container').classList.remove('hidden');

                const radioButtons = document.getElementsByName('computer_allocation');
                radioButtons.forEach((item) => {
                    if (item.checked) {
                        changeRoomAndComputerContainerState(item.value);
                    }
                });
            } else {
                document.getElementById('computer-allocation-container').classList.add('hidden');
                document.getElementById('room-computer-container').classList.add('hidden');
            }
        };

        const changeRoomAndComputerContainerState = (value) => {
            if (value === 'Allocate computer manually') {
                document.getElementById('room-computer-container').classList.remove('hidden');
            } else {
                document.getElementById('room-computer-container').classList.add('hidden');
            }
        }

        const changeComputerContents = (data) => {
            let printed = "<option value=\"\">-- Choose One --</option>";
            let template = "<option value=\"_computer.id_\">_computer.hostname_</option>";

            if (data.length === 0) {
                document.getElementById('computer').classList.add('border-red-500');
                document.getElementById('computer-error-message-container').innerHTML = '<span class="text-red-500">No computers available for borrowing.</span>'
            } else if (!beginning) {
                document.getElementById('computer').classList.remove('border-red-500');
                document.getElementById('computer-error-message-container').innerHTML = '';
            } else {
                beginning = !beginning;
            }

            data.forEach((item) => {
                const currentOption = template.replace('_computer.id_', item.id).replace('_computer.hostname_', item.hostname);
                printed += currentOption;
            });

            document.getElementById('computer').innerHTML = printed;
        };

        const fetchRoomComputers = async (value) => {
            if (value === '') {
                return;
            }

            let url = "{{ route('admin.ajax.computers.index', ['room' => '_room_']) }}";
            url = url.replace('_room_', value);

            fetch(url)
                .then(response => response.json())
                .then(changeComputerContents);
        };

        const onStatusChanged = (e) => {
            changeRejectionReasonContainerState(e.currentTarget.value);
            changeComputerAllocationContainerState(e.currentTarget.value);
        };

        const onComputerAllocationChanged = (e) => {
            changeRoomAndComputerContainerState(e.currentTarget.value);
        };

        const onRoomChanged = (e) => {
            fetchRoomComputers(e.currentTarget.value);
        };

        const onDocumentReady = () => {
            changeRejectionReasonContainerState("{{ old('status') ?? '' }}");
            changeComputerAllocationContainerState("{{ old('status') ?? '' }}");
            changeRoomAndComputerContainerState("{{ old('computer_allocation') ?? '' }}");

            fetchRoomComputers(document.getElementById('room').value);

            document.getElementById('status').onchange = onStatusChanged;
            document.getElementById('room').onchange = onRoomChanged;
            document.getElementsByName('computer_allocation').forEach((item) => {
                item.onchange = onComputerAllocationChanged;
            });
        };

        document.addEventListener('DOMContentLoaded', onDocumentReady);
    </script>
@endpush
