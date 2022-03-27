<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["name","photo_path"];

    public function get(){
        return DB::table("categories")->get();
    }
    public function venues(){
        return $this->belongsToMany(Venue::class,"venues_categories");
    }
}
