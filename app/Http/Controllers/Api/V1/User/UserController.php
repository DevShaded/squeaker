<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UpdateUserRequest;
use App\Http\Resources\Api\V1\Auth\UserResource;
use App\Http\Services\Api\V1\User\UserService;
use App\Trait\HttpResponses;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    use HttpResponses;

    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->success([
            'user' => new UserResource(Auth::user()),
        ], 200);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user = $this->userService->getUser($id);

        if (! $user) {
            return $this->error(null, 'User not found', 404);
        }

        return $this->success([
            'user' => $user,
        ], 200);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        if ($id != Auth::id()) {
            return $this->error(null, 'You cannot update other users than yourself', 401);
        }

        $request = $request->validated();

        $user = $this->userService->updateUser($request, Auth::id());

        return $this->success([
            'user' => $user,
        ], 200);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        if ($id != Auth::id()) {
            return $this->error(null, 'You cannot delete other users than yourself', 401);
        }

        $this->userService->deleteUser(Auth::id());

        return $this->success([
            'message' => 'User deleted successfully',
        ], 200);
    }
}
