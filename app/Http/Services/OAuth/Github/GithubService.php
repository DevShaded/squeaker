<?php

namespace App\Http\Services\OAuth\Github;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GithubService
{
    public function redirect(): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function store(): RedirectResponse
    {
        $user = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'email' => $user->getEmail(),
        ], [
            'name' => $user->getNickname(),
            'password' => Hash::make(Str::random(24)),
            'avatar' => $user->getAvatar() ?? 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($user->getNickname()))).'?s=200&d=mp',
        ]);

        Auth::login($user, true);

        return redirect()->to('/');
    }
}
