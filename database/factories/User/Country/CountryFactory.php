<?php

namespace Database\Factories\User\Country;

use App\Models\User\Country\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'name' => $this->faker->unique()->country,
        ];
    }
}
