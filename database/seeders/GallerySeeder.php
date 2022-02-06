<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Gallery::create([
            'image'=>'gal-1.jpg',
        ]);
        Gallery::create([
            'image'=>'gal-2.jpg',
        ]);
        Gallery::create([
            'image'=>'gal-3.jpg',
        ]);
    }
}
