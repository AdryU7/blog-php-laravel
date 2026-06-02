<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Main
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

// Admin
Route::get('/admin', [AdminController::class, 'index'])
       ->middleware('can:admin.index')
       ->name('admin.index');

// Admin routes
Route::namespace('App\Http\Controllers')->prefix('admin')->group(function() {
    // Articles (Controller inside of single quote)
    Route::resource('articles', 'ArticleController')
                ->except('show')
                ->names('articles');
    // Categories (Controller inside of single quote)
    Route::resource('categories', 'CategoryController')
                ->except('show')
                ->names('categories');
    // Comments (Controller inside of single quote)
    Route::resource('comments', 'CommentController')
                ->only('index', 'destroy')
                ->names('comments');
    Route::resource('users', 'UserController')
                ->except('create', 'store', 'show')
                ->names('users');
});

// Simple routes by Laravel excluding the 'show' instruction
Route::resource('articles', ArticleController::class)
                ->except('show')
                ->names('articles');

Route::resource('categories', CategoryController::class)
                ->except('show')
                ->names('categories');

Route::resource('comments', CommentController::class)
                ->only('index', 'destroy')
                ->names('comments');

// Profiles
Route::resource('profiles', ProfileController::class)
                // Se incluyó la ruta 'show' para mostrar los datos del perfil del usuario
                ->only('show', 'edit', 'update')
                ->names('profiles');

// View articles
Route::get('article/{article}', [ArticleController::class, 'show'])->name('articles.show');

// View articles by category
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

// Save comments
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');

Auth::routes();

/* // Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
*/

// > php artisan route:list