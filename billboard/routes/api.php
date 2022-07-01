<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::get('/advertisements', [\App\Http\Controllers\AdvertisementController::class, 'index']);
Route::get('/user-advertisements/{user}', [\App\Http\Controllers\AdvertisementController::class, 'userAdvertisements']);

Route::middleware('auth:sanctum')->post('/advertisements', [\App\Http\Controllers\AdvertisementController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
