<?php

namespace App\Http\Requests;

use App\Rules\WithinOperationalHours;
use Illuminate\Foundation\Http\FormRequest;

class BorrowingRequestStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_use' => [
                'required',
                'date',
                'after:+1 day',
            ],
            'start_time' => [
                'required',
                'date_format:H:i',
                new WithinOperationalHours,
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
                new WithinOperationalHours,
            ],
            'reason' => [
                'required',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'date_use.after' => 'The :attribute must be minimal 2 days from now',
        ];
    }
}
