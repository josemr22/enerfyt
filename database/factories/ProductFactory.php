<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            //
            'name' => $name,
            'slug' => Str::slug($name),
            'code' => $this->faker->randomNumber(8),
            'description' => $this->faker->paragraph(3),
            'price' => rand(12, 570) / 10,
            //'wholesale_price' => rand(12, 570) / 10,
            'category_id' => 1,
        ];
    }
}
