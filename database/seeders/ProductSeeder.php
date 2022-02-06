<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected $categories;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->fetchRelations();
        foreach(range(1, 10) as $i) {
            $this->createRandomProduct(false);
        }
        foreach(range(1, 8) as $i) {
            $this->createRandomProduct(true);
        }
    }

    protected function fetchRelations()
    {
        $this->categories = Category::all();
    }

    protected function createRandomProduct($novelties){
        $product = Product::factory()->create([
            'category_id' => $this->categories->random()->id,
            'featured' => $novelties,
        ]);
    }
}
