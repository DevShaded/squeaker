<?php

namespace App\Http\Controllers\Api\V1\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CommentRequest;
use App\Http\Services\Post\CommentService;
use App\Trait\HttpResponses;

class CreateCommentController extends Controller
{
    use HttpResponses;

    public function __construct(
        protected CommentService $commentService,
    ) {
    }

    public function __invoke(string $id, CommentRequest $request)
    {
        $comment = $this->commentService->createComment($id, $request);

        return $this->success([
            'comment' => $comment,
        ], 201, 201);
    }
}

