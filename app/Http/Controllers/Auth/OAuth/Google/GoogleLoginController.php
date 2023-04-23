<?php

namespace App\Http\Controllers\Auth\OAuth\Google;

use App\Http\Controllers\Controller;
use App\Http\Services\OAuth\Google\GoogleService;

class GoogleLoginController extends Controller
{
    public function __construct(
        protected GoogleService $googleService,
    ) {
    }

    public function redirect(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return $this->googleService->redirect();
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        return $this->googleService->store();
    }
}
