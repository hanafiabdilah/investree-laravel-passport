<?php

use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
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

Route::prefix('v1')->group(function() {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:api')->group(function() {
        
        Route::prefix('category')->group(function(){
            Route::post('/', [ArticleCategoryController::class, 'store'])->name('article-category.store');
        });

        Route::prefix('article')->group(function() {
            Route::get('/', [ArticleController::class, 'getAll'])->name('article.all');
            Route::post('/', [ArticleController::class, 'store'])->name('article.store');
            Route::get('/{id}', [ArticleController::class, 'getById'])->name('article.detail');
            Route::put('/{id}', [ArticleController::class, 'update'])->name('article.update');
            Route::delete('/{id}', [ArticleController::class, 'delete'])->name('article.delete');
        });

    });
});