<?php

namespace App\Http\Requests\Bus;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;

class Add_Bus_Request extends FormRequest
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
            // 'user_driver_id' => 'required|exists:users,id|unique:buses,user_driver_id|unique:cars,user_driver_id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'bus_type' => 'required|string|max:255',
            'bus_number' => 'required|string|max:255',
            'model' => 'required|string|max:225',
            'color' => 'required|string|max:225',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            //     $userDriverId = $this->input('user_driver_id');
            //     $user = User::find($userDriverId);
            //     if ($user && $user->user_type !== 'Driver') {
            //         $validator->errors()->add('user_driver_id', 'The selected user must be a driver.');
            //      }

            $vehicle_id = $this->input('vehicle_id');
            $vehicle = Vehicle::find($vehicle_id);
            if ($vehicle->vehicle_type !== 'Bus') {
                $validator->errors()->add('type_vehicle', 'The selected vehicle for bus not Bus.');
            }
        });
    }
}
