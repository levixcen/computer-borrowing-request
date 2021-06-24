<?php

namespace App\Rules;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Validation\Rule;

class WithinOperationalHours implements Rule
{
    private $operationalHours;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->operationalHours = config('borrowing-request.operational_hours');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $operationalStartTime = CarbonImmutable::createFromFormat('H:i', $this->operationalHours['from']);
        $operationalEndTime = CarbonImmutable::createFromFormat('H:i', $this->operationalHours['to']);
        $currentTime = CarbonImmutable::createFromFormat('H:i', $value);

        return $currentTime->between($operationalStartTime, $operationalEndTime);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute must be between {$this->operationalHours['from']} and {$this->operationalHours['to']}.";
    }
}
