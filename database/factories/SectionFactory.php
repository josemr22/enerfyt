<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name'=>$this->faker->sentence(3),
            'description'=>$this->faker->sentence(5),
            'price'=>random_int(5,80),
            'magazine_id'=>1,
        ];
    }
}
