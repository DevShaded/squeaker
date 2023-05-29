<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User\Country\Country;
use App\Models\User\UserInformation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User\User::factory(10)->create();

        $posts = \App\Models\Post\Post::factory(10)
            ->create([
                'user_id' => $user->random()->id,
            ]);

        foreach ($user as $u) {
            foreach ($posts as $p) {
                \App\Models\Post\Comment::factory(1)
                    ->create([
                        'user_id' => $u->id,
                        'post_id' => $p->id,
                    ]);
            }
        }

        $country = Country::factory(195)->create();

        UserInformation::factory(10)->create([
            'user_id' => $user->random()->id,
            'country_id' => $country->random()->id,
        ]);
    }
}
