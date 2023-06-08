<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\LoginUserRequest;
use App\Http\Requests\Api\V1\User\StoreUserRequest;
use App\Http\Resources\Api\V1\Auth\UserResource;
use App\Http\Services\Api\V1\Auth\AuthService;
use App\Trait\HttpResponses;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function __construct(
        protected AuthService $authService
    ) {}

    public function login(LoginUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $request = $request->validated();

        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = $this->authService->login($request);

        return $this->success([
            'user' => new UserResource($user),
            'token' => $user->createToken($user->name . '_token')->plainTextToken,
        ], 200);
    }

    public function register(StoreUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->authService->register($request);

        return $this->success([
            'user' => new UserResource($user),
            'token' => $user->createToken($user->name . '_token')->plainTextToken,
        ], 201);
    }
}
