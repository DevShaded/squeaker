<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UserResource;
use App\Models\Post\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Post\Comment */
class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'post' => new PostResource($this->whenLoaded('post')),
            'user' => new UserResource($this->whenLoaded('user')),
            'replies' => Reply::where('comment_id', $this->id)->get(),
        ];
    }
}
