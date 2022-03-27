<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
   protected $links = [
       ["name" => "Pocetna", "route" => "home"],
       ["name" => "Vikendice", "route" => "vikendice.index"],
       ["name" => "Kontakt", "route" => ""],
   ];
    public function run()
    {
       foreach ($this->links as $link){
           DB::table("menus")->insert([
               "name" => $link["name"],
               "route" => $link["route"],
           ]);
       }
    }
}
