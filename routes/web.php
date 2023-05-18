<?php

use App\Http\Controllers\Post\Comment\CreateCommentController;
use App\Http\Controllers\Post\Comment\Reply\CreateReplyController;
use App\Http\Controllers\Post\Dislike\DislikeController;
use App\Http\Controllers\Post\Like\LikeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\Search\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/squeak/{id}', [PostController::class, 'show']);
    Route::get('/post/create', [PostController::class, 'create']);
    Route::post('/post/store', [PostController::class, 'store']);

    Route::match(['get', 'post'], '/search', SearchController::class);

    Route::post('/squeak/{id}/like', LikeController::class);
    Route::post('/squeak/{id}/unlike', DislikeController::class);
    Route::post('/squeak/{id}/comment', CreateCommentController::class);
    Route::post('/squeak/{id}/reply', CreateReplyController::class);

    Route::post('/follow/{id}', App\Http\Controllers\User\Follow\FollowController::class);
    Route::post('/unfollow/{id}', App\Http\Controllers\User\Follow\UnFollowController::class);
});

Route::post('logout', function (Request $request) {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
});

require __DIR__.'/auth.php';
