<?php

namespace App\Http\Controllers\Api\V1\Post\Comment\Reply;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ReplyRequest;
use App\Http\Services\Post\CommentService;
use App\Trait\HttpResponses;

class CreateReplyController extends Controller
{
    use HttpResponses;

    public function __construct(
        protected CommentService $commentService,
    ) {
    }

    public function __invoke(string $id, ReplyRequest $request)
    {
        $reply = $this->commentService->createReply($id, $request);

        return $this->success([
            'reply' => $reply,
        ], 201, 201);
    }
}
