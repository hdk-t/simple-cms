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

Route::prefix('articles')->group(function(){
    Route::get('{articleId}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
});