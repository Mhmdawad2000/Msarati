<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'id' => 'exists:users,id',
            'fname' => 'required|regex:/^([A-Z]?([a-z]+)\s?)+$/',
            'lname' => 'required|regex:/^([A-Z]?([a-z]+)\s?)+$/',
            'phone' => 'required|regex:/^(\+963[0-9]{9})$/',
        ];
    }
}