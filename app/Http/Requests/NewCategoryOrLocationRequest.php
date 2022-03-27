<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCategoryOrLocationRequest extends FormRequest
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
            "name" => "bail|required|string|min:3|max:40|unique:locations,name",
            "photo_path" => "bail|required|file|mimes:jpg,jpeg,png|max:2048",
        ];
    }
    public function messages()
    {
        return [
          "name.required" => "Naziv je obavezno polje",
            "photo_path.required" => "Slika je obavezno polje.",
          "mimes" => "Slika mora bit formata: jpg,png iliu jpeg.",
          "name.min" => ":Attribute ne sme biti veci od :max karaktera.",
          "name.max" => ":Attribute ne sme biti veci od :max karaktera.",
          "file" => "Morate izabrati file koji je slika." ,
          "photo_path.max" => "Slika ne sme biti veca od :max kb."
        ];
    }
}
