<?php

namespace App\Http\Controllers\Post\Search;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        // get request input of a username and match it with the users table

        $users = UserResource::collection(User::where('name', 'like', '%'.$request->input('username').'%')->get());

        return Inertia::render('Search/Show', [
            'data' => $users,
        ]);
    }
}
