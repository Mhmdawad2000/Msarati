<?php

namespace App\Http\Requests\BusTrip;

use Illuminate\Foundation\Http\FormRequest;

class Add_Bus_Trip extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'trip_id' => 'required|exists:trips,id',
            'bus_id' => 'required|exists:buses,id',
        ];
    }
}