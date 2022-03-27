<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1,10)as $item){
            DB::table("venues")->insert([
                "name" => $faker->name,
                "max_guests" => rand(2,20),
                "num_rooms" => rand(1,12),
                "num_wc"=>rand(1,5),
                "num_beds"=>rand(2,10),
                "description"=>$faker->text,
                "address" => $faker->address,
                "square_footage" => rand(30,500),
                "location_id" => rand(1,9),
                "user_id" => rand(1,6),
            ]);
        }

    }
}
