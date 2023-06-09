<?php

namespace App\Http\Services\Api\V1\Post;

use App\Http\Resources\Post\PostResource;
use App\Http\Services\User\UserService;
use App\Models\Post\Post;
use App\Trait\HttpResponses;
use Exception;

class PostService
{
    use HttpResponses;

    public function __construct(
        protected UserService $userService
    ) {
    }

    public function getAllPosts(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PostResource::collection(Post::with(['user', 'likers'])
            ->withCount('comments')
            ->paginate(10));
    }

    public function getPost(string $id): PostResource|null
    {
        $post = Post::with(['user', 'comments', 'likers'])
            ->find($id);

        if (! $post) {
            return null;
        }

        return new PostResource($post);
    }

    public function createPost(array $request, string $userId): PostResource
    {
        $post = Post::create([
            'user_id' => $userId,
            'content' => $request['content'],
        ]);

        return new PostResource($post);
    }

    public function updatePost(array $request, string $id): ?PostResource
    {
        $post = Post::find($id);

        if (! $post) {
            return null;
        }

        $post->update($request);

        return new PostResource($post);
    }

    public function deletePost(string $id): bool
    {
        $post = Post::findOrFail($id);

        return $post->delete();
    }

    public function like(string $id): \Illuminate\Http\JsonResponse|PostResource
    {
        $user = $this->userService->getUser(auth()->id());
        $post = Post::find($id);

        if (! $post) {
            return $this->error(null, 'Post not found', 404);
        }

        if ($user->hasLiked($post)) {
            return $this->error(null, 'Post already liked');
        }

        $user->like($post);

        $getLikes = $post->likers->count();

        $post->increment('likes', $getLikes);

        return $this->success([
            'post' => new PostResource($post),
        ], 'Post liked successfully');
    }

    /**
     * @throws Exception
     */
    public function dislike(string $id): \Illuminate\Http\JsonResponse|PostResource
    {
        $user = $this->userService->getUser(auth()->id());
        $post = Post::find($id);

        if (! $post) {
            return $this->error(null, 'Post not found', 404);
        }

        if (! $user->hasLiked($post)) {
            return $this->error(null, 'You have not liked this post');
        }

        $user->unlike($post);

        $getLikes = $post->likers->count();

        $post->increment('likes', $getLikes);

        return $this->success([
            'post' => new PostResource($post),
        ], 'Post disliked successfully');
    }
}
