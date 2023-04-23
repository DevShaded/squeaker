<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ) {
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        return $this->authService->register($request);
    }
}
