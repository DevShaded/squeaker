<?php

namespace App\Http\Services\User;

use App\Http\Resources\User\UserResource;
use App\Models\User\User;

class UserService
{
    public function getWhoToFollow(): \Illuminate\Database\Eloquent\Collection
    {
        return User::select('id', 'name', 'avatar')
            ->inRandomOrder()
            ->limit(3)
            ->get();
    }

    public function getUser(string $id, $collection = false): UserResource
    {
        return new UserResource(User::with(['posts'])->findOrFail($id));
    }
}
