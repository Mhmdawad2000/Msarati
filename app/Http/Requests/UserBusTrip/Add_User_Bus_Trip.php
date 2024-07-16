<?php

namespace App\Http\Requests\UserBusTrip;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Add_User_Bus_Trip extends FormRequest
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
    public function rules(): array
    {
        return [
            'user_passenger_id' => [
                'required', 'exists:users,id',
                Rule::unique('user_bus_trips')->where(function ($query) {
                    return $query->where('bus_trip_id', $this->bus_trip_id);
                })
            ],
            'bus_trip_id' => 'required|exists:bus_trips,id',

        ];
    }


    public function messages()
    {
        return [
            'user_passenger_id.unique' => 'This User is already exists.'
        ];
    }
}