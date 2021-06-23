<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Schedule;
use Carbon\CarbonImmutable;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schedules = Schedule::query();

        if ($request->description !== null) {
            $schedules = $schedules->where('description', 'LIKE', "%{$request->description}%");
        }

        if ($request->room !== null) {
            $schedules = $schedules->where('room_id', $request->room);
        }

        if ($request->start_date !== null) {
            $startDate = CarbonImmutable::parse($request->start_date);
        }

        if ($request->end_date !== null) {
            $endDate = CarbonImmutable::parse($request->end_date);
        }

        if (isset($startDate) && isset($endDate)) {
            $startDate = $startDate->startOfDay();
            $endDate = $endDate->endOfDay();

            $schedules = $schedules->where([
                ['start_datetime', '<=', $endDate],
                ['end_datetime', '>=', $startDate],
            ]);
        } else if (isset($startDate)) {
            $startDate = $startDate->startOfDay();

            $schedules = $schedules->where('end_datetime', '>=', $startDate);
        } else if (isset($endDate)) {
            $endDate = $endDate->endOfDay();

            $schedules = $schedules->where('start_datetime', '<=', $endDate);
        }

        $schedules = $schedules->orderByDesc('start_datetime')->paginate(10);

        return view('admin.schedule.index', [
            'schedules' => $schedules,
            'rooms' => Room::all(),
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
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        return view('admin.schedule.show', [
            'schedule' => $schedule,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
