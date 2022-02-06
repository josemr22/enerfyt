<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(range(1, 3) as $i) {
            Category::factory()->create([
                'image' => 'category-'.$i.'.jpg',
            ]);
        }
    }
}
