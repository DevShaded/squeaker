<?php

namespace App\Http\Services\Auth;

use App\Models\User\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthService
{
    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            event(new Login('web', Auth::user(), $request->filled('remember')));

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' => ['required', 'string', 'same:password'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($request->name))).'?s=200&d=mp',
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->to('/');
    }
}
