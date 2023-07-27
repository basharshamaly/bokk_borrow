<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jop_title' => $this->faker->name(),
            'user_id' => $this->faker->randomNumber(),
        ];
    }
}