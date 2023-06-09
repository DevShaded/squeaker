<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UserResource;
use App\Models\Post\Post;
use App\Models\Post\Reply;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Post\Comment */
class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'post' => new PostResource(Post::where('id', $this->post_id)->first()),
            'user' => UserResource::collection(User::where('id', $this->user_id)->get()),
            'replies' => Reply::with('user')->where('comment_id', $this->id)->get(),
        ];
    }
}
