<?php

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Services\Api\V1\Post\PostService;
use App\Trait\HttpResponses;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
    ) {
    }

    use HttpResponses;

    public function index()
    {
        return $this->success([
            'posts' => $this->postService->getAllPosts(),
        ], 200);
    }

    public function store(PostRequest $request)
    {
        $request = $request->validated();

        $post = $this->postService->createPost($request, auth()->id());

        return $this->success([
            'post' => $post,
        ], 201, 201);
    }

    public function show(string $id)
    {
        $post = $this->postService->getPost($id);

        if (! $post) {
            return $this->error(null, 'Post not found', 404);
        }

        return $this->success([
            'post' => $post,
        ], 200);
    }

    public function update(PostRequest $request, string $id)
    {
        $request = $request->validated();

        $getPost = $this->postService->getPost($id);

        if (! $getPost) {
            return $this->error(null, 'Post not found', 404);
        }

        if ($getPost->user_id != auth()->id()) {
            return $this->error(null, 'You cannot update other users posts.', 401);
        }

        $post = $this->postService->updatePost($request, $id);

        if (! $post) {
            return $this->error(null, 'An error accrued', 500);
        }

        return $this->success([
            'post' => $post,
        ], 200);
    }

    public function destroy(string $id)
    {
        $getPost = $this->postService->getPost($id);

        if (! $getPost) {
            return $this->error(null, 'Post not found', 404);
        }

        if ($getPost->user_id != auth()->id()) {
            return $this->error(null, 'You cannot delete other users posts.', 401);
        }

        $post = $this->postService->deletePost($id);

        if (! $post) {
            return $this->error(null, 'An error accrued', 500);
        }

        return $this->success('Post deleted successfully', 200);
    }
}
