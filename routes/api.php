<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\post_ct;
use App\Http\Controllers\like_controller;
use App\Http\Controllers\comment_management;
use App\Http\Controllers\follow_management;
use App\Http\Controllers\users;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("post", [post_ct::class, 'new_post']);
Route::post("like_post", [like_controller::class, 'like_post']);
Route::post("comment_post", [comment_management::class, 'comment_post']);
Route::post("following", [follow_management::class, 'following']);

Route::post("unfollow", [follow_management::class, 'unfollow']);

Route::get("profile/{nama}", [users::class, 'profile']);
Route::get("find/{nama?}", [users::class, 'finds']);
Route::get("all_post", [post_ct::class, 'index']);
