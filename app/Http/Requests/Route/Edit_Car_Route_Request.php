<?php

namespace App\Http\Requests\Route;

use Illuminate\Foundation\Http\FormRequest;

class Edit_Car_Route_Request extends FormRequest
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
            'id' => 'required"exists:car_routes,id',
            'car_id' => 'required|exists:cars,id',
            'route_id' => 'required|exists:routes,id'
        ];
    }
}