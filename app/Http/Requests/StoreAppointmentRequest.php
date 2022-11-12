<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'identifier_use'        =>  'required|string',
            'identifier_type'       =>  'required|string',
            'identifier_system'     =>  'required|string',
            'identifier_value'      =>  'required|string',
            'identifier_start'      =>  'required|string',
            'identifier_end'        =>  'nullable|string',
            'identifier_assigner'   =>  'required|string',
            'status'                =>  'nullable|string',
            'participant_1'         =>  'nullable|string',
            'participant_2'         =>  'nullable|string',
            'performer'             =>  'nullable|uuid',
        ];
    }
}
