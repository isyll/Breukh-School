<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname'  => 'required',
            'lastname'   => 'required',
            'gender'     => ['required', Rule::in(['male', 'female'])],
            'birthdate'  => 'sometimes|date',
            'birthplace' => 'sometimes',
            'profile'    => ['required', Rule::in(['internal', 'external'])],
            'classe'     => 'required|exists:classes,id',
        ];
    }
}