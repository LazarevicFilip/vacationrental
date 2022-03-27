<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabSeeder extends Seeder
{
    private $tabs = [
        ["name" => "Korisnicka informacija", "route" => "profile"],
        ["name" => "Moji oglasi", "route" => "oglasi"],
        ["name" => "Dodaj oglas", "route" => "vikendice.create"],
        ["name" => "Promeni lozinku", "route" => "changePasswordForm"],
    ];
    public function run()
    {
        foreach ($this->tabs as $tab){
            DB::table("tabs")->insert([
               "name" => $tab["name"],
               "route" => $tab["route"],
            ]);
        }
    }
}
