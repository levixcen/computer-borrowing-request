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
        if ($event->borrowingRequest->status !== 'Accept') {
            return;
        }

        $room = $event->room;
        $computer = $event->computer;

        if (empty($event->room) && empty($event->computer)) {
            $computer = Computer::available($event->borrowingRequest->start_datetime, $event->borrowingRequest->end_datetime)
                ->first();
            $room = $computer->room;
        } else if (empty($event->computer)) {
            $computer = Computer::available($event->borrowingRequest->start_datetime, $event->borrowingRequest->end_datetime, $room)
                ->first();
        } else {
            $computer = Computer::available($event->borrowingRequest->start_datetime, $event->borrowingRequest->end_datetime, $room, $computer)
                ->first();
        }

        if (empty($computer)) {
            $message = 'No available computers left from ' . $event->borrowingRequest->start_datetime . ' to ' . $event->borrowingRequest->end_datetime;

            if (! empty($room)) {
                $message .= ' in ' . $room->name;
            }

            if (! empty($computer)) {
                $message .= ', computer ' . $computer->hostname;
            }

            Log::error($message);
            throw new ErrorException($message);
        }

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
