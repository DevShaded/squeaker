<?php

namespace App\Http\Controllers\Api\V1\User\Follow;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\User\Follow\FollowService;
use App\Trait\HttpResponses;

class FollowController extends Controller
{
    use HttpResponses;

    public function __construct(
        protected FollowService $followService
    ) {
    }

    public function follow(string $id): \Illuminate\Http\JsonResponse
    {
        $follow = $this->followService->follow($id);

        if ($follow === 404) {
            return $this->error('User not found', 404);
        }

        if ($follow === null) {
            return $this->error('You are already following this user', 400);
        }

        return $this->success([
            'message' => 'You are now following this user',
            'user_id' => $id,
        ], 200);
    }

    public function unfollow(string $id): \Illuminate\Http\JsonResponse
    {
        $unfollow = $this->followService->unfollow($id);

        if ($unfollow === 404) {
            return $this->error('User not found', 404);
        }

        if ($unfollow === null) {
            return $this->error('You are not following this user', 400);
        }

        return $this->success([
            'message' => 'You are no longer following this user',
            'user_id' => $id,
        ], 200);
    }
}
