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
            'ControllerName' => $this->faker->name,
            'ProjectName' => $this->faker->name,
            'SerialNumber' => $this->faker->unique()->numberBetween(0, 10000000),
            'RegisteredOn' => $this->faker->dateTime,
            'ExternalAddress' => $this->faker->ipv4
        ];
    }
}
