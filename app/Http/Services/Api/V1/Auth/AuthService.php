<?php

namespace App\Http\Services\Api\V1\Auth;

use App\Http\Requests\Api\V1\User\StoreUserRequest;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $request): User
    {
        return User::where('email', $request['email'])->first();
    }

    public function register(StoreUserRequest $request)
    {
        $request = $request->validated();

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'avatar' => 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($request['name']))).'?s=200&d=mp',
            'password' => Hash::make($request['password']),
        ]);
    }
}
