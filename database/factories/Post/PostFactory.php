<?php

namespace Database\Factories\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->uuid,
            'likes' => 0,
            'views' => 0,
            'content' => $this->faker->text(280),
        ];
    }
}
