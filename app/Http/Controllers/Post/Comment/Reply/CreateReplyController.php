<?php

namespace App\Http\Controllers\Post\Comment\Reply;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ReplyRequest;
use App\Http\Services\Post\CommentService;

class CreateReplyController extends Controller
{
    public function __construct(
        protected CommentService $commentService,
    ) {
    }

    public function __invoke(string $id, ReplyRequest $request)
    {
        $this->commentService->createReply($id, $request);

        return redirect()->back();
    }
}
