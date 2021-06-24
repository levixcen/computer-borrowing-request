<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\BorrowingRequestApprovedConstructorDto;
use App\Events\BorrowingRequestApproved;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BorrowingRequestUpdateRequest;
use App\Models\BorrowingRequest;
use App\Models\Computer;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BorrowingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.borrowing-request.index', [
            'borrowingRequests' => BorrowingRequest::orderByDesc('created_at')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BorrowingRequest  $borrowingRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BorrowingRequest $borrowingRequest)
    {
        return view('admin.borrowing-request.show', [
            'borrowingRequest' => $borrowingRequest,
            'rooms' => Room::available()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BorrowingRequest  $borrowingRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(BorrowingRequest $borrowingRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\BorrowingRequestUpdateRequest  $request
     * @param  \App\Models\BorrowingRequest  $borrowingRequest
     * @return \Illuminate\Http\Response
     */
    public function update(BorrowingRequestUpdateRequest $request, BorrowingRequest $borrowingRequest)
    {
        $room = Room::find($request->room);
        $computer = Computer::find($request->computer);

        if (empty($room) && empty($computer)) {
            $computer = Computer::available($borrowingRequest->start_datetime, $borrowingRequest->end_datetime)
                ->first();

            $room = $computer->room ?? null;
        } else if (empty($computer)) {
            $computer = Computer::available($borrowingRequest->start_datetime, $borrowingRequest->end_datetime, $room)
                ->first();
        } else {
            $computer = Computer::available($borrowingRequest->start_datetime, $borrowingRequest->end_datetime, $room, $computer)
                ->first();
        }

        if (empty($computer)) {
            $message = 'No available computers left from ' . $borrowingRequest->start_datetime . ' to ' . $borrowingRequest->end_datetime;
            $tempComputer = Computer::find($request->computer);

            if (! empty($room)) {
                $message .= ' in ' . $room->name;
            }

            if (! empty($tempComputer)) {
                $message = 'Computer ' . $tempComputer->hostname . ', room ' . $room->name . ' not available from ' . $borrowingRequest->start_datetime . ' to ' . $borrowingRequest->end_datetime;
            }

            return redirect()->back()->withErrors([
                'available_computer' => $message . '.',
            ]);
        }

        if (! empty($request->status) && $request->status === 'Rejected') {
            $borrowingRequest->update($request->only(['status', 'rejection_reason']));
        } else {
            $borrowingRequest->update($request->only(['status']));

            BorrowingRequestApproved::dispatch(new BorrowingRequestApprovedConstructorDto($borrowingRequest->user, $borrowingRequest, $room, $computer));
        }

        return redirect()->route('admin.borrowing-requests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BorrowingRequest  $borrowingRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(BorrowingRequest $borrowingRequest)
    {
        //
    }
}
