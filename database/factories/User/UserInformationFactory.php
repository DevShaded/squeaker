<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserInformationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->uuid,
            'description' => $this->faker->text,
            'dob' => $this->faker->date,
            'country_id' => $this->faker->country,
            'website' => $this->faker->url,
        ];
    }
}
