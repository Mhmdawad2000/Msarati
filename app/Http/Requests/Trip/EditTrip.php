<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;

class EditTrip extends FormRequest
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
            'id' => 'required|exists:trips,id',
            'route_id' => 'required|exists:routes,id|integer',
            'days' => 'required|json',
            'type' => 'required|string|max:255',
            'time' => 'required|date_format:H:i',
        ];
    }
}
