<?php

use App\Http\Controllers\{CategoryController, PostController};
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

Route::controller(CategoryController::class)->group(function () {
    Route::get('category', 'index');
    Route::post('category', 'store');
});

Route::controller(PostController::class)->group(function () {
    Route::get('post', 'index');
    Route::post('post', 'store');
    Route::patch('post/{id}/publish', 'publish');
});
