<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $k=1;
        foreach (range(1, 25) as $i) {
            $j = random_int(1, 5);
            Post::factory()->create([
                'image' => $k . '.jpg',
                'category_id'=>$j,
            ]);
            $k++;
            if($k==6){
                $k=1;
            }
        }
    }
}
