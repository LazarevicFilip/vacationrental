<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    private $categories = [
        ["name" => "Splav","path" => "splav.jpg"],
        ["name" => "Luksuzne vile","path" => "vila.jpg"],
        ["name" => "Vikendice za proslave","path" => "proslave.jpg"],
        ["name" => "Vikendice sa bazenom","path" => "bazen.jpg"],
        ["name" => "Vikendica za odmor","path" => "odmor.jpg"],
        ["name" => "Welness i spa","path" => "spa.jpg"],
        ["name" => "Etno kuce","path" => "etno.jpg"],
    ];


    public function run()
    {
        foreach ($this->categories as $category){
            DB::table("categories")->insert([
                "name" => $category["name"],
                "photo_path" =>  $category["path"]
            ]);
        }
    }
}
