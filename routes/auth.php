<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuth\Github\GitHubLoginController;
use App\Http\Controllers\Auth\OAuth\Google\GoogleLoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('login', [LoginController::class, 'authenticate']);

    Route::get('login/github', [GitHubLoginController::class, 'redirect'])
        ->name('github.login');

    Route::get('login/github/redirect', [GitHubLoginController::class, 'store']);

    Route::get('login/google', [GoogleLoginController::class, 'redirect']);

    Route::get('login/google/redirect', [GoogleLoginController::class, 'store']);
});
