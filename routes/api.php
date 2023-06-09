<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Post\Comment\CreateCommentController;
use App\Http\Controllers\Api\V1\Post\Comment\Reply\CreateReplyController;
use App\Http\Controllers\Api\V1\Post\Dislike\DislikeController;
use App\Http\Controllers\Api\V1\Post\Like\LikeController;
use App\Http\Controllers\Api\V1\Post\PostController;
use App\Http\Controllers\Api\V1\Post\Search\SearchController;
use App\Http\Controllers\Api\V1\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::resource('user', UserController::class)->except(['create', 'edit', 'store']);
        Route::resource('post', PostController::class)->except(['create', 'edit']);

        Route::post('/post/{id}/like', LikeController::class);
        Route::post('/post/{id}/unlike', DislikeController::class);

        Route::post('/post/{id}/comment', CreateCommentController::class);
        Route::post('/post/{id}/reply', CreateReplyController::class);

        Route::get('/search/{query}', SearchController::class);
    });
});
