<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('layouts.register_layout');
});

Route::get('/create', function () {
    return view('components.home.create');
});

Route::post('/logout',[UserController::class,'logout']);
Route::post('/login',[UserController::class,'login']);
Route::get('/user/create', [UserController::class,'create']);
Route::post('/user', [UserController::class,'store']);

Route::get('/reset', [PasswordController::class,'reset']);
Route::post('/send-reset', [PasswordController::class,'send_reset']);
Route::get('/reset-password/{email}', [PasswordController::class,'reset_password_view']);
Route::put('/reset-password', [PasswordController::class,'reset_password']);

Route::get('/blogs/search',[BlogController::class, 'search']);
Route::put('/blogs', [UserController::class,'update']);

Route::resource('users', UserController::class);
Route::resource('blogs', BlogController::class);

Route::get('/{username}', [BlogController::class,'our_blogs']);

Route::post('/likes/{id}/add', [LikeController::class,'like']);
Route::post('/like-comments/{id}/add', [LikeController::class,'like_comment']);

Route::post('/comment', [CommentController::class,'store']);
Route::post('/reply/{id}', [CommentController::class,'reply']);