<?php

namespace App\Dtos;

use App\Models\BorrowingRequest;
use App\Models\Computer;
use App\Models\Room;
use App\Models\User;

class BorrowingRequestApprovedConstructorDto
{
    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    private $user;

    /**
     * The borrowing request instance.
     *
     * @var \App\Models\BorrowingRequest
     */
    private $borrowingRequest;

    /**
     * The room instance.
     *
     * @var \App\Models\Room|null
     */
    private $room = null;

    /**
     * The computer instance.
     *
     * @var \App\Models\Computer|null
     */
    private $computer = null;

    /**
     * BorrowingRequestRejectedConstructorDto constructor.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BorrowingRequest $borrowingRequest
     * @param \App\Models\Room|null $room
     * @param \App\Models\Computer|null $computer
     */
    public function __construct(User $user, BorrowingRequest $borrowingRequest, Room $room = null, Computer $computer = null)
    {
        $this->user = $user;
        $this->borrowingRequest = $borrowingRequest;

        if (! empty($room)) {
            $this->room = $room;
        }

        if (! empty($computer)) {
            $this->computer = $computer;
        }
    }

    /**
     * Get user isntance.
     *
     * @return \App\Models\User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Get borrowing request instance.
     *
     * @return \App\Models\BorrowingRequest
     */
    public function getBorrowingRequest(): BorrowingRequest
    {
        return $this->borrowingRequest;
    }

    /**
     * Get room instance.
     *
     * @return \App\Models\Room|null
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Get computer instance.
     *
     * @return \App\Models\Computer|null
     */
    public function getComputer()
    {
        return $this->computer;
    }
}
