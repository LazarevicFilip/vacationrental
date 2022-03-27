<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email" => "required|email",
            "password" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/"
        ];
    }

    public function messages()
    {
        return [
            "required" => ":Attribute polje je obavezno",
            "email.email" => "Unesite validnu email adresu",
            "password.regex" => "Lozinka mora imati 8 karaktera,od toga cifru,veliko i malo slovo"
        ];
    }
}
