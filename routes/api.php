<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'create']);
// Route::post('logout', 'AuthController@logout');
// Route::post('refresh', 'AuthController@refresh');
Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);

Route::post('message', [App\Http\Controllers\Message::class, 'storeMessage']);
Route::post('get_message', [App\Http\Controllers\Message::class, 'getMessage']);
Route::put('message/{id}',[App\Http\Controllers\Message::class, 'updateMessage']);
Route::delete('message/{id}',[App\Http\Controllers\Message::class, 'destroy']);
Route::get('user', [App\Http\Controllers\Message::class, 'members']);