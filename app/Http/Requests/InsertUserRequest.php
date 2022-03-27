<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertUserRequest extends FormRequest
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
            "nameUI" => "required|min:5|max:50",
            "emailUI" => "required|email",
            "phoneUI" => "required|regex:/^06\d{7,8}$/",
            "roleUI" => ["required","exists:roles,id",function($attribute, $value, $fail){
                    if($value == 1){
                        $fail("Ne dozvoljena vrednost za ulogu.");
                    }
            }],
            "passwordUI" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            "passwordConfUI" => "required|same:passwordUI"
        ];
    }
    public function messages()
    {
        return [
          "required" => ":attribute polje je obavezno.",
          "email" => "Email mora biti u ispravnom formatu",
          "nameUI.max" => "Ime i prezime ne smeju biti duzi od 30 karaktera",
            "exists" => "Izabrana uloga :attribute je ne vazeca",
            "same" => "Lozinke se ne poklapaju"
        ];
    }
}
