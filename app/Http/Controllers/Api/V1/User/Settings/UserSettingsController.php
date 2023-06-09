<?php

namespace App\Http\Controllers\Api\V1\User\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Trait\HttpResponses;

class UserSettingsController extends Controller
{
    use HttpResponses;

    public function __invoke(UserUpdateRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return $this->success([
            'user' => $request->user(),
        ], 'User updated successfully');
    }
}
