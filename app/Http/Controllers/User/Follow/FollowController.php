<?php

namespace App\Http\Controllers\User\Follow;

use App\Http\Controllers\Controller;
use App\Http\Services\User\FollowService;

class FollowController extends Controller
{
    public function __construct(
        protected FollowService $followService
    ) {
    }

    public function __invoke(string $id): \Illuminate\Http\RedirectResponse
    {
        return $this->followService->follow($id);
    }
}
