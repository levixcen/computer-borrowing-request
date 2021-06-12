<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingRequestStoreRequest;
use App\Models\BorrowingRequest;
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
        return view('borrowing-request.index', [
            'borrowingRequests' => BorrowingRequest::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('borrowing-request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BorrowingRequestStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BorrowingRequestStoreRequest $request)
    {
        dd($request->all());
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
