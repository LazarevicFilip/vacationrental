<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class venueRequest extends FormRequest
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
        if(request()->isMethod("post")){
            $filePresent = "required";
            $min = 4;
        }elseif (request()->isMethod("put")){
            $filePresent = "sometimes";
            $min = 1;
        }
        return [
            "name" => "required|string|min:3|max:40",
            "address" => "required|string|min:5|max:60",
            "square_footage" => "required|integer|min:30|max:2000",
            "categories" => "required|array|min:1",
            "categories.*" => "required|exists:categories,id",
            "additional" => "required|array|min:4",
            "additional.*" => "required|exists:additional_contents,id",
            "location_id" => "required|exists:locations,id",
            "max_guests" => "required|integer|min:1|max:50",
            "num_rooms" => "required|integer|min:1|max:20",
            "num_wc" => "required|integer|min:1|max:10",
            "num_beds" => "required|integer|min:1|max:20",
            "description" => "required|string|min:20",
            "photos" => "$filePresent|array|min:$min",
            "photos.*" => "file|max:2048|mimes:jpg,png,jpeg",
            "price" => "required|numeric|gt:9",
            "user_id" => "required|numeric|min:1",
        ];
    }

    public function messages()
    {
        return [
            "required" => ":Attribute je obavezan podatak.",
            "min" => ":Attribute mora biti duzi od :min karaktera.",
            "photos.min" => "Morate izabrati barem :min slike.",
            "additional.min" => "Morate izabrati barem :min stavke dodatnog sdrzaja.",
            "categories.min" => "Morate izabrati barem :min kategoriju.",
            "max" => ":Attribute mora biti kraci od :max karaktera.",
            "array" => ":Attribute - morate izabrati vise stavki.",
            "photos.array" => "Morate izabrati vise slika.",
            "mimes" => "Slike moraju biti formata jpg,png,jpeg.",
            "integer" => ":Attribute mora biti broj.",
            "file" => "Svaki izabrani fajl mora biti slika.",
            "exists" => ":Attribute nema validan sadrzaj.",
            "string" => ":Attribute mora biti string.",
            "gt" => ":Attribute po nocenju mora biti veci od 9 evra."
        ];
    }
    protected function prepareForValidation(){
        if($this->request->get("file") == null){
            $this->request->remove("file");
        }
    }
}
