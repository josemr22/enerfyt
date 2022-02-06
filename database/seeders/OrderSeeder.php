<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    protected $destinations;
    protected $products;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->destinations=Destination::all();
        $this->products=Product::all();
        foreach(range(1, 10) as $i) {
            $destination=$this->destinations->random();
            $this->createRandomOrder($destination);
        }
    }

    function createRandomOrder($destination){
        $order = Order::factory()->create([
            'destination_id'=>$destination->id,
            'tariff'=>$destination->tariff,
        ]);
        $rows=random_int(1,4);
        foreach (range(1,$rows) as $i){
            $product=$this->products->random();
            $order->items()->attach($product->id,[
                'quantity'=>random_int(1,5),
                'saleprice'=>$product->price,
            ]);
        }
    }
}
