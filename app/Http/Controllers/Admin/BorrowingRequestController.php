<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\BorrowingRequestApprovedConstructorDto;
use App\Events\BorrowingRequestApproved;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BorrowingRequestUpdateRequest;
use App\Models\BorrowingRequest;
use App\Models\Computer;
use App\Models\Room;
use Illuminate\Http\Request;

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
            'rooms' => Room::all(),
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
        if (! empty($request->status) && $request->status === 'Reject') {
            $borrowingRequest->update($request->only(['status', 'rejection_reason']));
        } else {
            $borrowingRequest->update($request->only(['status']));
        }

        if (! empty($request->room) && ! empty($request->computer)) {
            $room = Room::find($request->room);
            $computer = Computer::find($request->computer);
            $dto = new BorrowingRequestApprovedConstructorDto($borrowingRequest->user, $borrowingRequest, $room, $computer);
        } else if (! empty($request->room)) {
            $room = Room::find($request->room);
            $dto = new BorrowingRequestApprovedConstructorDto($borrowingRequest->user, $borrowingRequest, $room);
        } else {
            $dto = new BorrowingRequestApprovedConstructorDto($borrowingRequest->user, $borrowingRequest);
        }

        BorrowingRequestApproved::dispatch($dto);

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
