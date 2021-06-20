<?php

namespace App\Events;

use App\Dtos\BorrowingRequestApprovedConstructorDto;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BorrowingRequestApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The borrowing request instance.
     *
     * @var \App\Models\BorrowingRequest
     */
    public $borrowingRequest;

    /**
     * The room instance.
     *
     * @var \App\Models\Room|null
     */
    public $room;

    /**
     * The computer instance.
     *
     * @var \App\Models\Computer|null
     */
    public $computer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BorrowingRequestApprovedConstructorDto $dto)
    {
        $this->user = $dto->getUser();
        $this->borrowingRequest = $dto->getBorrowingRequest();
        $this->room = $dto->getRoom();
        $this->computer = $dto->getComputer();
    }
}
