<?php

namespace App\Http\Controllers\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CommentRequest;
use App\Http\Services\Post\CommentService;

class CreateCommentController extends Controller
{
    public function __construct(
        protected CommentService $commentService,
    ){ }

    public function __invoke(string $id, CommentRequest $request)
    {
        $this->commentService->createComment($id, $request);

        return redirect()->back()->with('success', 'Comment created successfully');
    }
}
