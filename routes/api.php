<?php

use App\Http\Controllers\Api\V1\AccessTokensController;
use App\Http\Controllers\Api\V1\PostsController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('V1')->group(function() {
    Route::apiResource('/posts', PostsController::class);

    Route::get('/access-tokens', [AccessTokensController::class, 'index'])
        ->middleware('auth:sanctum');
    Route::post('/access-tokens', [AccessTokensController::class, 'store']);
    Route::delete('/access-tokens', [AccessTokensController::class, 'destroy'])
        ->middleware('auth:sanctum');
});
