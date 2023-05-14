<?php

namespace Tests\Feature\Post;

use App\Models\Post\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        Auth::login($user);

        return $user;
    }

    public function test_it_can_display_the_index_page()
    {
        $user = $this->authenticate();
        $posts = Post::factory()->count(10)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/');

        $response->assertSuccessful();
        $response->assertSee($posts->first()->title);
    }

    public function test_it_can_display_the_create_page()
    {
        $user = $this->authenticate();

        $response = $this->actingAs($user)->get('/post/create');

        $response->assertSuccessful();
    }

    public function test_it_can_store_a_post()
    {
        $user = $this->authenticate();

        $response = $this->actingAs($user)->post('/post/store', [
            'content' => 'Lorem ipsum dolor sit amet.',
        ]);

        $this->assertDatabaseHas('posts', [
            'content' => 'Lorem ipsum dolor sit amet.',
            'user_id' => $user->id,
        ]);
        $response->assertRedirect('/');
    }

    public function test_test_it_can_display_a_single_post()
    {
        $user = $this->authenticate();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/squeak/'.$post->id);

        $response->assertSuccessful();
        $response->assertSee($post->title);
        $response->assertSee($post->content);
    }
}
