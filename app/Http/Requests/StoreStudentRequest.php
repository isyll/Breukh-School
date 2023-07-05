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
        $date = date_format(date_create(), 'Y-m-d');
        $date = strtotime("$date - 5 year");
        $date = date('Y-m-d', $date);

        return [
            'firstname'  => 'required',
            'lastname'   => 'required',
            'gender'     => ['required', Rule::in(['male', 'female'])],
            'birthdate'  => "sometimes|date|before_or_equal:$date",
            'birthplace' => 'sometimes',
            'profile'    => ['required', Rule::in(['internal', 'external'])],
            'classe'     => 'required|exists:classes,id',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'status' => 1,
        ]);
    }
}