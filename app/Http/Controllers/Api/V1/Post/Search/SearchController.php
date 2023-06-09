<?php

namespace App\Http\Controllers\Api\V1\Post\Search;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Auth\UserResource;
use App\Models\User\User;
use App\Trait\HttpResponses;

class SearchController extends Controller
{
    use HttpResponses;

    public function __invoke(string $query)
    {
        $users = UserResource::collection(User::where('name', 'like', '%'.$query.'%')->get())->map(function ($user) {
            return $user->only('id', 'name', 'avatar');
        });

        return $this->success([
            'users' => $users,
        ], 200);
    }
}
