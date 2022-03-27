<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalContent extends Model
{
    use HasFactory;

    public function venues(){
        return $this->belongsToMany(Venue::class,"additional_contents_venues");
    }
}
