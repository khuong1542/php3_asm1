<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plate_number' => rand(10000, 99999),
            'owner' => $this->faker->name(),
            'travel_fee' => rand(1000, 9999),
        ];
    }
}
