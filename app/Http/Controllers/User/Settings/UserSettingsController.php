<?php

namespace App\Http\Controllers\User\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserSettingsController extends Controller
{
    public function edit(Request $request): \Inertia\Response
    {
        return Inertia::render('User/Settings/Edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(UserUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return redirect()->to('/user/settings')->with('success', 'User updated successfully');
    }

    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
