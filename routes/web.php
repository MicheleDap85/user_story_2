<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/create', [ArticleController::class, 'create'])->name('article.create');
Route::get('/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('/show/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('article.byCategory');
