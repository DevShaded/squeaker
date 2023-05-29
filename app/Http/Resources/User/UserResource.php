<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\Country\CountryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User\User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'information' => new UserInformationResource($this->whenLoaded('information')),
            'country' => CountryResource::collection($this->whenLoaded('information.userCountry')),
            'posts' => PostResource::collection($this->whenLoaded('posts')),
            'followers' => UserResource::collection($this->whenLoaded('followers')),

            'is_following' => $this->isFollowedBy(auth()->user()),

            'followers_count' => $this->whenLoaded('followers', function () {
                return $this->followers->count();
            }),

            'following_count' => $this->followings->count(),
        ];
    }
}
