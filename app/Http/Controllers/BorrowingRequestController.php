<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingRequestStoreRequest;
use App\Models\BorrowingRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user.borrowing-request.index', [
            'borrowingRequests' => BorrowingRequest::where('user_id', $request->user()->id)->orderByDesc('created_at')->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.borrowing-request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BorrowingRequestStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BorrowingRequestStoreRequest $request)
    {
        $data = [
            'start_datetime' => Carbon::createFromFormat('Y-m-d H:i', $request->date_use . ' ' . $request->start_time),
            'end_datetime' => Carbon::createFromFormat('Y-m-d H:i', $request->date_use . ' ' . $request->end_time),
            'reason' => $request->reason,
        ];

        $borrowingRequest = new BorrowingRequest;
        $borrowingRequest->user()->associate($request->user());
        $borrowingRequest->fill($data);
        $borrowingRequest->save();

        return redirect()->route('borrowing-requests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BorrowingRequest  $borrowingRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BorrowingRequest $borrowingRequest)
    {
        return view('borrowing-request.show', [
            'borrowingRequest' => $borrowingRequest,
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BorrowingRequest  $borrowingRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BorrowingRequest $borrowingRequest)
    {
        //
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
