<?php

namespace App\Http\Controllers\Api\V1\Post\Like;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Post\PostService;
use App\Trait\HttpResponses;

class LikeController extends Controller
{
    use HttpResponses;

    public function __construct(
        protected PostService $postService
    ) {
    }

    public function __invoke(string $id)
    {
        return $this->postService->like($id);
    }
}
