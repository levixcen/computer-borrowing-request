<?php

namespace App\Http\Services;

use App\Models\Computer;
use App\Models\User;

class ScheduleService
{
    /**
     * Generate description for borrowing request.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Computer $computer
     * @return string
     */
    public function handleGenerateBorrowingDescription(User $user, Computer $computer): string
    {
        return 'Borrowing-' . $computer->hostname . '-' . $user->email;
    }
}
