<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            "password" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            "newPassword" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            "confirmPassword" => "required|same:newPassword"
        ];
    }
    public function messages()
    {
        return [
            "required" => ":Attribute je obavezno polje",
            "regex" => "Lozinka mora imatri najmanje 8 karaktera,bar po jednu cifru i jedno veliko i malo slovo",
            "confirmPassword.same" => "Nova lozinka se ne poklapa sa potvrdjenom lozinkom"
        ];
    }
}
