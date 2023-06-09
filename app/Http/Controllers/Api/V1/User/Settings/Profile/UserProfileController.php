<?php

namespace App\Http\Controllers\Api\V1\User\Settings\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserInformationRequest;
use App\Http\Services\Post\PostService;
use App\Http\Services\User\UserService;
use App\Trait\HttpResponses;

class UserProfileController extends Controller
{
    use HttpResponses;

    public function __construct(
        protected UserService $userService,
        private readonly PostService $postService
    ) {
    }

    public function show(string $name)
    {
        $user = $this->userService->getUserByName($name);
        $posts = $this->postService->getPostsFromUser($user->id);

        return $this->success([
            'user' => $user,
            'posts' => $posts,
        ], 200);
    }

    public function update(UserInformationRequest $request)
    {
        $validated = $request->validated();
        $user = $this->userService->getUser(auth()->id());
        $avatar = $request->file('avatar');

        if ($avatar) {
            $this->userService->storeAvatar($avatar, $user);
        }

        if (isset($validated['country'])) {
            $country = $this->userService->getCountryByName($validated['country']);
        }

        $user->update([
            'name' => $validated['name'] ?? $user->name,
            'email' => $validated['email'] ?? $user->email,
        ]);

        $user->information()->updateOrCreate([
            'user_id' => $user->id,
        ], [
            'description' => $validated['description'] ?? $user->information->description ?? null,
            'dob' => $validated['dob'] ?? $user->information->dob ?? null,
            'country_id' => $country ?? null,
            'website' => $validated['website'] ?? $user->information->website ?? null,
        ]);

        // get the updated user
        $user = $this->userService->getUser(auth()->id());

        return $this->success([
            'user' => $user,
        ], 'Your profile has been updated');
    }
}
