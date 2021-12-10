<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Article\Http\Controllers\API\ArticleCategoryController;
use Modules\Article\Http\Controllers\API\ArticleController;

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

// Route::middleware('auth:api')->get('/article', function (Request $request) {
//     return $request->user();
// });

Route::prefix('article')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/category', [ArticleCategoryController::class, 'index']);
});


