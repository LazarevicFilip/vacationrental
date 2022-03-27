<?php

namespace App\Rules;

use App\Models\Reservation;
use Illuminate\Contracts\Validation\Rule;

class UniqueDateForVenue implements Rule
{
    protected $reservations;
    protected $venue_id;

    public function __construct($id)
    {
        $this->reservations = Reservation::all();
        $this->venue_id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->reservations->where("date",$value)->where("venue_id",$this->venue_id)->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Objekat je rezervisan na izabrani datum.';
    }
}
