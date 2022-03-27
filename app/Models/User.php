<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $hidden = ["password","deleted_at","created_at","updated_at"];

    protected $visible = ["id","name","email","role_id","phone"];

    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function venues(){
        return $this->hasMany(Venue::class);
    }
}
