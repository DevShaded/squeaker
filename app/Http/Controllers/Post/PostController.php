<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Services\Post\PostService;
use App\Http\Services\User\UserService;
use App\Models\Post\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected UserService $userService,
    ) {
    }

    public function index(): \Inertia\Response
    {
        $data = [
            'posts' => [
                'recent' => $this->postService->getRecentPosts(),
                'mostLiked' => $this->postService->getMostLikedPosts(),
            ],
            'whoToFollow' => $this->userService->getWhoToFollow(),
            'trendingPosts' => Post::with(['user'])
                ->withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->limit(3)
                ->get(),
        ];

        return Inertia::render('Index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(PostRequest $request)
    {
        $this->postService->createPost($request);

        return redirect()->to('/');
    }

    public function show(string $id)
    {
        $post = $this->postService->getPost($id);

        return Inertia::render('Post/Show', [
            'data' => $post,
        ]);
    }
}
