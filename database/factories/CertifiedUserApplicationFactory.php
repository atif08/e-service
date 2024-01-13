<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CertifiedUserApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'graduated_field' => $this->faker->word,
            'country_id' => 1,
            'university_id' => 1,
        ];
    }
}
