<?php

namespace App\Http\Requests\Car;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;

class Add_Car_Request extends FormRequest
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
            'user_driver_id' => 'required|exists:users,id|unique:cars,user_driver_id|',
            'vehicle_id' => 'required|exists:vehicles,id',
            'car_type' => 'required|string|max:255',
            'car_number' => 'required|string|max:255',
            'model' => 'required|string|max:225',
            'color' => 'required|string|max:225',
            'num_passengers' => 'required|integer|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $userDriverId = $this->input('user_driver_id');
            $vehicle_id = $this->input('vehicle_id');
            $user = User::find($userDriverId);
            $vehicle = Vehicle::find($vehicle_id);
            if ($user && $user->user_type !== 'driver') {
                $validator->errors()->add('user_driver_id', 'The selected user must be a driver.');
            }
            if ($vehicle && $vehicle->num_passengers < $this->input('num_passengers')) {
                $validator->errors()->add('num_passengers', 'The selected num_passengers must be max ' . $vehicle->num_passengers . ' and min 1.');
            }
        });
    }
}