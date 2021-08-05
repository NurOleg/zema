<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\App\UserController;
use App\Http\Controllers\App\CityController;
use App\Http\Controllers\App\FriendshipController;
use App\Http\Controllers\App\PublicationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify', [AuthController::class, 'verify']);

Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/{user}/edit', [UserController::class, 'edit']);
Route::post('/users/{user}', [UserController::class, 'update']);

//Route::resource('users', UserController::class);
Route::resource('cities', CityController::class);
Route::resource('publications', PublicationController::class);

Route::get('/{user}/friendship/requests', [FriendshipController::class, 'requests']);
Route::post('/{user}/friendship/request', [FriendshipController::class, 'addRequest']);
Route::get('/friendship/friends', [FriendshipController::class, 'friends']);
Route::post('/{user}/friendship/friends/delete', [FriendshipController::class, 'deleteFriend']);
Route::get('/friendship/requests/{friend_request}/apply', [FriendshipController::class, 'applyRequest']);
Route::get('/friendship/requests/{friend_request}/reject', [FriendshipController::class, 'rejectRequest']);
