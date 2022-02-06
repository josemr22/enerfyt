<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Square;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SquareSeeder extends Seeder
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
        $fecha=Carbon::now();
        foreach(range(1, 80) as $i) {
            $fecha=Carbon::now()->subtract(random_int(0,10), 'days');
            $square=Square::factory()->create([
                'created_at'=>$fecha
            ]);
            $products=$this->products->random(rand(1,4));
            foreach ($products as $product){
                $square->products()->attach($product,[
                    'quantity'=>rand(1,5),
                ]);
            }
        }
        // $squarer=Square::factory()->create([
        //     'id'=>9999999,
        // ]);
        // $productr=$this->products->random();
        // $colorr=$product->colors->random()->id;
        // $squarer->products()->attach($productr,[
        //     'quantity'=>rand(1,5),
        //     'color_id'=>$colorr,
        //     'size_id'=>$product->sizes->random()->id,
        // ]);
        // $squarer->products()->attach($productr,[
        //     'quantity'=>rand(1,5),
        //     'color_id'=>null,
        //     'size_id'=>$product->sizes->random()->id,
        // ]);
    }
}
