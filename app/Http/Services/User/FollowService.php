<?php

namespace App\Http\Services\User;

use App\Models\User;

class FollowService
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function follow(string $id): \Illuminate\Http\RedirectResponse
    {
        $user = $this->userService->getUser(auth()->id());
        $userToFollow = User::findOrFail($id);

        $user->follow($userToFollow);

        return redirect()->back();
    }

    public function unfollow(string $id): \Illuminate\Http\RedirectResponse
    {
        $user = $this->userService->getUser(auth()->id());
        $userToUnfollow = User::findOrFail($id);

        $user->unfollow($userToUnfollow);

        return redirect()->back();
    }
}
