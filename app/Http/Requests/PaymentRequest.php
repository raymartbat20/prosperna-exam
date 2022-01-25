<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'middle_name' => 'nullable|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'mobile' => 'nullable|digits:11'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First name is required',
            'first_name.regex' => 'First name should only contain letters and white spaces',
            'last_name.required' => 'Last name is required',
            'last_name.regex' => 'Last name should only contain letters and white spaces',
            'middle_name.regex' => 'Middle name should only contain letters and white spaces',
            'email.required' => 'Email is required',
            'mobile.digits' => 'Number should consist 11 digits',
        ];
    }
}
