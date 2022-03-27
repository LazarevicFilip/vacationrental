<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
           LocationSeeder::class,
           CategorySeeder::class,
           VenueSeeder::class,
           AdditionalContentsSeeder::class,
            RoleSeeder::class,
            MenuSeeder::class,
            TabSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
