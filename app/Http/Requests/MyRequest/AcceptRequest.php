<?php

namespace App\Http\Requests\MyRequest;

use App\Models\Request;
use Illuminate\Foundation\Http\FormRequest;

class AcceptRequest extends FormRequest
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
            'id' => 'required|exists:requests,id'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $id = $this->input('id');
            $request = Request::find($id);
            if ($request != 'Waiting') {
                $validator->errors()->add('status', 'The time period is invalid.');
            }
        });
    }
}
