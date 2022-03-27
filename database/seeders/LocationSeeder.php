<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{

    private $locations = [
        ["name" => "Kopaonik","path" => "kopaonik.jpg"],
        ["name" => "Tara","path" => "tara.jpg"],
        ["name" => "Zlatibor","path" => "zlatibor.jpg"],
        ["name" => "Okolina Beograda","path" => "beograd.jpg"],
        ["name" => "Okolina Novog Sada","path" => "novi_sad.jpg"],
        ["name" => "Palic","path" => "palic.png"],
        ["name" => "Srebrno jezero","path" => "srebrno_jezero.jpg"],
        ["name" => "Fruska Gora","path" => "fruska_gora.jpg"],
        ["name" => "Soko banja","path" => "soko_banja.jpg"],
    ];

    public function run()
    {
        foreach ($this->locations as $location){
            DB::table("locations")->insert([
               "name" => $location["name"],
                "photo_path" =>  $location["path"]
            ]);
        }
    }
}
