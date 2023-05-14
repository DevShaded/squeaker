<?php

namespace App\Http\Controllers\Post\Like;

use App\Http\Controllers\Controller;
use App\Http\Services\Post\PostService;

class LikeController extends Controller
{
    public function __construct(
        protected PostService $postService,
    ) {
    }

    public function __invoke(string $id): \Illuminate\Http\RedirectResponse
    {
        $this->postService->like($id);

        return redirect()->back();
    }
}
