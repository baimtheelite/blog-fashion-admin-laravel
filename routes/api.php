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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['cors'])->prefix('article')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/category', [ArticleCategoryController::class, 'index']);
});


// Route::middleware(['api'])->prefix('article')->group(function () {
//     Route::get('/', [ArticleController::class, 'index']);
//     Route::get('/category', [ArticleCategoryController::class, 'index']);
// });

// Route::group(['prefix' => 'article', 'middleware' => ['cors']], function () {
//     Route::get('/', [ArticleController::class, 'index']);
//     Route::get('/category', [ArticleCategoryController::class, 'index']);
// });
