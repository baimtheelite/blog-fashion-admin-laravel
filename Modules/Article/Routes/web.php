<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Article\Http\Controllers\API\ArticleCategoryController as APIArticleCategoryController;
use Modules\Article\Http\Controllers\ArticleCategoryController;
use Modules\Article\Http\Controllers\ArticleController;

Route::prefix('article')->group(function() {
    Route::get('/', [ArticleController::class, 'index'])->name('article.index');
    Route::post('/', [ArticleController::class, 'index']);
    Route::get('/category', [ArticleCategoryController::class, 'index'])->name('article.category.index');
    Route::post('/category', [ArticleCategoryController::class, 'index']);


});

