<?php

namespace App\Http\Controllers\Auth\OAuth\Github;

use App\Http\Controllers\Controller;
use App\Http\Services\OAuth\Github\GithubService;

class GitHubLoginController extends Controller
{
    public function __construct(
        protected GithubService $githubService,
    ) {
    }

    public function redirect(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return $this->githubService->redirect();
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        return $this->githubService->store();
    }
}
