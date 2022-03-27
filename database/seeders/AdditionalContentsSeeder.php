<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalContentsSeeder extends Seeder
{
    private $data = ["Basta","Cisti Peskiri","Kamin","Sadrzaj za decu","TV","Wifi","Bazen","Balkon","Spa","Rostilj","Parking","Garaza","Klima uredaj","Fen za kosu","Prilagodjno invalidima","Dvoriste","Ves masina","Pet frendly","Kuhinja"];

    public function run()
    {
      foreach ($this->data as $item){
          DB::table("additional_contents")->insert([
                "name" => $item
          ]);
      }
    }
}
