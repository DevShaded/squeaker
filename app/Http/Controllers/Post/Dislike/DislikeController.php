<?php

namespace App\Http\Controllers\Post\Dislike;

use App\Http\Controllers\Controller;
use App\Http\Services\Post\PostService;
use Exception;

class DislikeController extends Controller
{
    public function __construct(
        protected PostService $postService,
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(string $id): \Illuminate\Http\RedirectResponse
    {
        $this->postService->dislike($id);

        return redirect()->back();
    }
}
