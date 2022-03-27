<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    protected $fillable = ["name","photo_path"];
    use HasFactory;
    public function get(){
        return DB::table("locations")->get();
    }
}
