<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderState;
use App\Models\PayMode;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name'=>$this->faker->name,
            'phone'=>$this->faker->randomNumber(9),
            'email'=>$this->faker->email,
            'address'=>$this->faker->address,
            'reference'=>$this->faker->sentence(4),
            'detail'=>$this->faker->paragraph(1),
            'delivery'=>$this->faker->boolean,
            //'tariff'=>$this->faker->numberBetween(15,150),
            'tariff'=>$this->faker->randomFloat(2,5,10),
            'pay_method'=>PayMode::getList()[array_rand(PayMode::getList())],
            'state'=>array_rand(OrderState::getList()),
            'total'=>$this->faker->randomFloat(2,15,200)
        ];
    }
}
