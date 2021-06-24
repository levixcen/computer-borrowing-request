<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingRequestStoreRequest;
use App\Models\BorrowingRequest;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

        $currentUserSchedules = Schedule::whereHas('user', function (Builder $query) use ($request) {
            $query->where('email', $request->user()->email);
        })->where([
            ['start_datetime', '<=', $data['end_datetime']],
            ['end_datetime', '>=', $data['start_datetime']],
        ])->get();

        $currentUserBorrowingRequests = BorrowingRequest::whereHas('user', function (Builder $query) use ($request) {
            $query->where('email', $request->user()->email);
        })->where([
            ['start_datetime', '<=', $data['end_datetime']],
            ['end_datetime', '>=', $data['start_datetime']],
        ])->noStatus()->get();

        if (! $currentUserSchedules->isEmpty() || ! $currentUserBorrowingRequests->isEmpty()) {
            return redirect()->back()->withErrors([
                'schedule' => 'You can only borrow computer once in the specified start and end datetime.',
            ]);
        }

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
