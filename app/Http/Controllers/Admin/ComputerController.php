<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ComputerStoreRequest;
use App\Http\Requests\Admin\ComputerUpdateRequest;
use App\Models\Computer;
use App\Models\Room;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $room = Room::find($request->room);

        return view('admin.computer.create', [
            'room' => $room,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ComputerStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComputerStoreRequest $request)
    {
        $computer = new Computer;
        $computer->room()->associate($request->room);
        $computer->fill($request->only(['hostname', 'ip_address']));
        $computer->save();

        return redirect()->route('admin.rooms.edit', ['room' => $request->room]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Computer $computer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function edit(Computer $computer)
    {
        return view('admin.computer.edit', [
            'computer' => $computer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ComputerUpdateRequest  $request
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function update(ComputerUpdateRequest $request, Computer $computer)
    {
        $computer->room()->associate($request->room);
        $computer->update($request->only(['hostname', 'ip_address']));

        $room = Room::find($request->room);

        return redirect()->route('admin.rooms.edit', ['room' => $room]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Computer $computer)
    {
        $computer->delete();

        return redirect()->back();
    }
}
