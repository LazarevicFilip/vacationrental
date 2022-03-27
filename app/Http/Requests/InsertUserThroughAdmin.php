<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertUserThroughAdmin extends FormRequest
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
            "name" => "required|min:5|max:50",
            "email" => "required|email",
            "phone" => "required|regex:/^06\d{7,8}$/",
            "role" => "required|exists:roles,id",
            "password" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            "passwordConf" => "required|same:password"
        ];
    }
    public function messages()
    {
        return [
            "required" => ":Attribute polje je obavezno.",
            "email" => "Email mora biti u ispravnom formatu.",
            "regex" => ":Attribute nije u dobrom formatu.",
            "nameUI.max" => "Ime i prezime ne smeju biti duzi od 30 karaktera.",
            "exists" => "Izabrana uloga :attribute je nevazeca.",
            "same" => "Lozinke se ne poklapaju."
        ];
    }
}
