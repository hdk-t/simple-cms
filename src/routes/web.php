<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::prefix('articles')->group(function() {
    Route::get('{articleId}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
});
Route::group(['middleware' => 'basicauth'], function() {
    Route::prefix(config('admin.admin_route_path'))->group(function() {
        Route::get('/', function() { return redirect()->route('admin.auth.form'); });
        Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'form'])->name('admin.auth.form');
        Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.auth.login');
        Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.auth.logout');
        Route::group(['middleware' => 'adminauth'], function() {
            Route::prefix('articles')->group(function() {
                Route::get('/', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin.articles.index');
                Route::get('create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('admin.articles.create');
                Route::post('create/preview', [App\Http\Controllers\Admin\ArticleController::class, 'createPreview'])->name('admin.articles.create.preview');
                Route::post('store/{storeType}', [App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('admin.articles.store');
                Route::get('{articleId}/pictures/create', [App\Http\Controllers\Admin\ArticleController::class, 'pictureCreate'])->name('admin.articles.pictures.create');
            });
        });
    });
});
