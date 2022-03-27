<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    private $roles = ["Admin","Kupac","Prodavac"];

    public function run()
    {
        foreach ($this->roles as $role){
            DB::table("roles")->insert([
                "name" => $role
            ]);
        }

    }
}
