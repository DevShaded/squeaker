<?php

namespace Database\Factories\Post;

use App\Models\Post\Comment;
use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
            'post_id' => Post::factory(),
        ];
    }
}
