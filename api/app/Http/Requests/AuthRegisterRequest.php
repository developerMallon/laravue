<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'branche' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'password' => 'required|string|min:8|max:30|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/'
        ];
    }
}
