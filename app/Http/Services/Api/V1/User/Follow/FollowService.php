<?php

namespace App\Http\Services\Api\V1\User\Follow;

use App\Http\Services\User\UserService;
use App\Models\User\User;
use App\Trait\HttpResponses;

class FollowService
{
    use HttpResponses;

    public function __construct(
        protected UserService $userService
    ) {
    }

    public function follow(string $id): bool|int|null
    {
        $user = $this->userService->getUser(auth()->id());
        $userToFollow = User::find($id);

        if (! $userToFollow) {
            return 404;
        }

        if ($user->isFollowing($userToFollow)) {
            return null;
        }

        $user->follow($userToFollow);

        return true;
    }

    public function unfollow(string $id): bool|int|null
    {
        $user = $this->userService->getUser(auth()->id());
        $userToUnFollow = User::find($id);

        if (! $userToUnFollow) {
            return 404;
        }

        if (! $user->isFollowing($userToUnFollow)) {
            return null;
        }

        $user->unfollow($userToUnFollow);

        return true;
    }
}
