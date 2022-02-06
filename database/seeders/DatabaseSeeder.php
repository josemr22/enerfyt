<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DestinationSeeder::class,
            //CategorySeeder::class,
            //ProductSeeder::class,
            //ImageSeeder::class,
            SliderSeeder::class,
            UserSeeder::class,
            //OrderSeeder::class,
            //SquareSeeder::class,
            //CategoryPostSeeder::class,
            //PostSeeder::class,
            //MessageSeeder::class,
            ServiceSeeder::class,
            GallerySeeder::class,
            InformationSeeder::class,
        ]);
    }
}
