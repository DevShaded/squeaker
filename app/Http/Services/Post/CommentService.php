<?php

namespace App\Http\Services\Post;

use App\Http\Requests\Post\CommentRequest;
use App\Http\Requests\Post\ReplyRequest;
use App\Models\Post\Comment;
use App\Models\Post\Reply;

class CommentService
{
    public function createComment(string $id, CommentRequest $request): Comment
    {
        return Comment::create($request->validated());
    }

    public function createReply(string $id, ReplyRequest $request): Reply
    {
        return Reply::create($request->validated());
    }

    public function deleteReply(string $id): ?bool
    {
        return Reply::findOrFail($id)->delete();
    }
}
