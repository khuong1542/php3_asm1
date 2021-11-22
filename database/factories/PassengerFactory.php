<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'car_id' => rand(1, 10),
            'travel_time' => $this->faker->dateTime($max = 'now', $timezone = null),
        ];
    }
}
