<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ServiceName' => $this->faker->randomElement(Service::TYPES),
            'LicenseNumber' => $this->faker->unique()->numberBetween(0,10000000),
            'MaxDate' => now(),
            'Enabled' => $this->faker->boolean()
        ];
    }
}
