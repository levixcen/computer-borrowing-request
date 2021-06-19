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
                    Email Requestor: {{ $borrowingRequest->user->email }}
                </div>
                <div>
                    Request At: {{ $borrowingRequest->created_at }}
                </div>
                <div>
                    Start Time: {{ $borrowingRequest->start_datetime }}
                </div>
                <div>
                    End Time: {{ $borrowingRequest->end_datetime }}
                </div>
                <div>
                    Reason: {{ $borrowingRequest->reason }}
                </div>
            </div>
        </div>
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
                        <option value="Accept" @if ((old('status') ?? '') === 'Accept') selected @endif>Approve</option>
                        <option value="Reject" @if ((old('status') ?? '') === 'Reject') selected @endif>Reject</option>
                    </select>
                    @error('status')
                        <span class="text-red-500">{{ $errors->first('status') }}</span>
                    @enderror
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
                <div class="mt-4">
                    <button class="btn bg-green-500 text-white p-2 hover:bg-green-700" type="submit">
                        Update Status
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const changeRejectionReasonContainerState = (value) => {
            if (value === 'Reject') {
                document.getElementById('rejection-reason-container').classList.remove('hidden');
            } else {
                document.getElementById('rejection-reason-container').classList.add('hidden');
            }
        };

        const onStatusChanged = (e) => {
            changeRejectionReasonContainerState(e.currentTarget.value);
        };

        const onDocumentReady = () => {
            changeRejectionReasonContainerState("{{ old('status') ?? '' }}");
            document.getElementById('status').onchange = onStatusChanged;
        };

        document.addEventListener('DOMContentLoaded', onDocumentReady);
    </script>
@endpush
