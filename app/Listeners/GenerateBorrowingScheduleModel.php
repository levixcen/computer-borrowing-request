<?php

namespace App\Listeners;

use App\Events\BorrowingRequestApproved;
use App\Http\Services\ScheduleService;
use App\Models\Computer;
use App\Models\Schedule;
use ErrorException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GenerateBorrowingScheduleModel
{
    /**
     * The schedule service instance.
     *
     * @var ScheduleService
     */
    private $scheduleService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * Handle the event.
     *
     * @param  BorrowingRequestApproved  $event
     * @return void
     */
    public function handle(BorrowingRequestApproved $event)
    {
        if ($event->borrowingRequest->status !== 'Approved') {
            return;
        }

        $room = $event->room;
        $computer = $event->computer;

        $schedule = new Schedule;
        $schedule->borrowingRequest()->associate($event->borrowingRequest);
        $schedule->user()->associate($event->user);
        $schedule->room()->associate($room);
        $schedule->computer()->associate($computer);

        $data = [
            'description' => $this->scheduleService->handleGenerateBorrowingDescription($event->user, $computer),
            'start_datetime' => $event->borrowingRequest->start_datetime,
            'end_datetime' => $event->borrowingRequest->end_datetime,
            'username' => 'prk',
            'password' => Str::random(10),
        ];

        $schedule->fill($data);
        $schedule->save();
    }
}
