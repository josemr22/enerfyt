<?php

namespace Database\Factories;

use App\Models\Square;
use App\Models\SquareType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SquareFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Square::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'type'=>array_rand(SquareType::getList()),
            'commentary'=>$this->faker->sentence(5),
        ];
    }
}
