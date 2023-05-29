<?php

namespace App\Http\Services\Post;

use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Services\User\UserService;
use App\Models\Post\Post;
use Exception;

class PostService
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function getRecentPosts(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PostResource::collection(Post::with(['user', 'likers'])->withCount('comments')->latest()->simplePaginate(10));
    }

    public function getMostLikedPosts(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PostResource::collection(Post::with(['user'])->withCount('comments')->orderBy('likes', 'desc')->simplePaginate(10));
    }

    public function getPost(string $id): PostResource
    {
        return new PostResource(Post::with(['user', 'comments', 'likers'])->findOrFail($id));
    }

    public function getPostsFromUser(string $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PostResource::collection(Post::with(['user', 'likers'])->where('user_id', $id)->latest()->simplePaginate(10));
    }

    public function like(string $id): \Illuminate\Http\RedirectResponse
    {
        $user = $this->userService->getUser(auth()->id());
        $post = Post::findOrFail($id);

        $user->like($post);

        $getLikes = $post->likers->count();

        $post->increment('likes', $getLikes);

        return redirect()->back();
    }

    /**
     * @throws Exception
     */
    public function dislike(string $id): \Illuminate\Http\RedirectResponse
    {
        $user = $this->userService->getUser(auth()->id());
        $post = Post::findOrFail($id);

        $user->unlike($post);

        $getLikes = $post->likers->count();

        $post->update(['likes' => $getLikes]);

        return redirect()->back();
    }

    public function createPost(PostRequest $request): Post
    {
        $user = $this->userService->getUser(auth()->id());

        return $user->posts()->create($request->validated());
    }
}
