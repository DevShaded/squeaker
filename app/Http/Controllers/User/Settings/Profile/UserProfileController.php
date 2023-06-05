<?php

namespace App\Http\Controllers\User\Settings\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserInformationRequest;
use App\Http\Services\Post\PostService;
use App\Http\Services\User\UserService;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function __construct(
        protected UserService $userService,
        private readonly PostService $postService
    ) {
    }

    public function show(string $name)
    {
        $user = $this->userService->getUserByName($name);
        $posts = $this->postService->getPostsFromUser($user->id);

        $data = [
            'user' => $user,
            'posts' => $posts,
        ];

        return Inertia::render('User/Show', [
            'data' => $data,
        ]);
    }

    public function edit()
    {
        return Inertia::render('User/Settings/Profile/Edit', [
            'user' => $this->userService->getUser(auth()->id()),
            'countries' => $this->userService->getCountries(),
        ]);
    }

    public function update(UserInformationRequest $request)
    {
        $validated = $request->validated();
        $user = $this->userService->getUser(auth()->id());
        $avatar = $request->file('avatar');

        if ($avatar) {
            $this->userService->storeAvatar($avatar, $user);
        }

        if ($validated['country']) {
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

        return redirect()->to('/user/'.$user->name);
    }
}
