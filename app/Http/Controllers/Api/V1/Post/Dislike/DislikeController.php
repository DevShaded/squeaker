<?php

namespace App\Http\Controllers\Api\V1\Post\Dislike;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Post\PostService;
use App\Trait\HttpResponses;
use Exception;

class DislikeController extends Controller
{
    use HttpResponses;

    public function __construct(
        protected PostService $postService
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(string $id)
    {
        return $this->postService->dislike($id);
    }
}
