<?php

namespace App\Http\Requests\Bus;

use App\Models\Bus;
use App\Models\Car;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;

class Edit_Bus_Request extends FormRequest
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
            'id' => 'required|exists:buses,id',
            // 'user_driver_id' => 'required|exists:users,id',
            // 'vehicle_id' => 'required|exists:vehicles,id',
            'bus_type' => 'required|string|max:255',
            'bus_number' => 'required|string|max:255',
            'model' => 'required|string|max:225',
            'color' => 'required|string|max:225',
        ];
    }


    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         $userDriverId = $this->input('user_driver_id');
    //         $id = $this->input('id');
    //         $user = User::find($userDriverId);
    //         $bus = Bus::where('user_driver_id', $userDriverId)->first();
    //         $iscar = Car::where('user_driver_id', $userDriverId)->first();
    //         if ($user && $user->user_type !== 'Driver') {
    //             $validator->errors()->add('user_driver_id', 'The selected user must be a driver.');
    //         }
    //         if ($bus && $id !== $bus->id || $iscar) {
    //             $validator->errors()->add('user_driver_id', 'The user driver id has already been taken.');
    //         }
    //     });
    // }
}
