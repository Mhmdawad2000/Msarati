<?php

namespace App\Http\Requests\MyRequest;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'route_id' => 'required|exists:routes,id|integer',
            'user_passenger_id' => 'required|exists:users,id|integer',
            'num_passengers' => 'required|integer|min:1',
        ];
    }
}
