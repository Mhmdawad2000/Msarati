<?php

namespace App\Http\Requests\Bus;

use Illuminate\Foundation\Http\FormRequest;

class AddStop extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'city' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'lang' => 'required|numeric',
            'time' => 'required|date_format:H:i'
        ];
    }
}
