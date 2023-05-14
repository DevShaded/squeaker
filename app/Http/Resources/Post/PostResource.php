<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

/** @mixin \App\Models\Post\Post */
class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'likes' => $this->likes,
            'views' => $this->views,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'comments_count' => DB::table('comments')->where('post_id', $this->id)->count(),
            'has_liked' => $this->isLikedBy(auth()->user()),

            'user_id' => $this->user_id,

            'user' => new UserResource($this->whenLoaded('user')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
