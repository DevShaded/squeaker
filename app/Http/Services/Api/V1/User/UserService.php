<?php

namespace App\Http\Services\Api\V1\User;

use App\Http\Resources\Api\V1\Auth\UserResource;
use App\Models\User\User;
use App\Trait\HttpResponses;

class UserService
{
    use HttpResponses;

    public function getUser(string $id): UserResource|bool
    {
        $user = User::find($id);

        if (! $user) {
            return false;
        }

        return new UserResource($user);
    }

    public function updateUser(array $request, $id): UserResource|\Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);

        if (! $user) {
            return $this->error('', 'User not found', 404);
        }

        $user->update($request);

        return new UserResource($user);
    }

    public function deleteUser(string $id)
    {
        $user = User::findOrFail($id);

        if (! $user) {
            return $this->error('', 'User not found', 404);
        }

        return $user->delete();
    }
}
