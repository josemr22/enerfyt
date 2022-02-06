<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    protected $products;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->products=Product::all();
        foreach(range(1, 16) as $i) {
            $j='';
            $i<10 ? $j='0' : $j='';
            Image::create([
                'name'=>"product-$j$i.jpg",
                'product_id' => $this->products->random()->id,
            ]);
        }
    }
}
