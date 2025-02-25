<?php

use App\Http\Controllers\Api\ArticleController;
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
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::resource('articles', ArticleController::class);
// Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
// Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
