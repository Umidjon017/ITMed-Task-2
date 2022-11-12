<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'identifier_use'        =>  'nullable|string',
            'identifier_type'       =>  'nullable|string',
            'identifier_system'     =>  'nullable|string',
            'identifier_value'      =>  'nullable|string',
            'identifier_start'      =>  'nullable|string',
            'identifier_end'        =>  'nullable|string',
            'identifier_assigner'   =>  'nullable|string',
            'status'                =>  'required|string',
            'participant_1'         =>  'nullable|string',
            'participant_2'         =>  'nullable|string',
            'performer'             =>  'nullable|uuid',
        ];
    }
}
