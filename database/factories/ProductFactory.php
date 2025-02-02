<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'controller_name' => "Controller of ". $this->faker->name,
            'project_name' => $this->faker->name,
            'serial_number' => $this->faker->unique()->numberBetween(0, 10000000),
            'registered_on' => $this->faker->dateTime,
            'external_address' => $this->faker->ipv4
        ];
    }
}
