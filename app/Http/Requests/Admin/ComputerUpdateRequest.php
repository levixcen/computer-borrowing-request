<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ComputerUpdateRequest extends FormRequest
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
            'room' => [
                'required',
                'exists:rooms,id',
            ],
            'hostname' => [
                'required',
                'unique:computers,hostname,' . $this->route('computer')->id,
            ],
            'ip_address' => [
                'required',
                'ip',
            ],
        ];
    }
}
