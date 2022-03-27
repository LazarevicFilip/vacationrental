<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ["price","venue_id"];

    public function venue(){
        return $this->belongsTo(Venue::class);
    }
}
