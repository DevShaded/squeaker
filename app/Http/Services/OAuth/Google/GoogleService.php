<?php

namespace App\Http\Services\OAuth\Google;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleService
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        $user = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'email' => $user->getEmail(),
        ], [
            'name' => $user->getName(),
            'password' => Hash::make(Str::random(24)),
            'avatar' => $user->getAvatar() ?? 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($user->getName()))).'?s=200&d=mp',
        ]);

        Auth::login($user, true);

        return redirect()->to('/');
    }
}
