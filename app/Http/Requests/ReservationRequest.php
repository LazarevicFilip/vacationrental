<?php

namespace App\Http\Requests;

use App\Rules\UniqueDateForVenue;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            "user_id" => "required|exists:users,id",
            "venue_id" => "required|exists:venues,id",
            "date" => ["required","after:today",new UniqueDateForVenue("venue_id")]
        ];
    }
    public function messages()
    {
        return [
            "venue_id.required" => "Korisnik je obavezno polje.",
            "user_id.required" => "Oglas je obavezno polje.",
            "venue_id.exists" => "Korisnik mora postojati.",
            "user_id.exists" => "Oglas mora postojati.",
            "date.required" => "Morate izabrati datum.",
            "date.after" => "Ne mozete izabrati datum u proslosti.",
        ];
    }
}
