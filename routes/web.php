<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/', [HomeController::class, 'message'])->name('message');

Route::get('/admin', [AdminController::class, 'admin_create'])->name('admin.create');
Route::post('/admin', [AdminController::class, 'category_delete'])->name('delete.category');
Route::post('/add_category', [AdminController::class, 'category_store'])->name('add.category');

Route::get('/category/{slug}', [HomeController::class, 'category_create'])->name('category.create');

Route::get('/login', [UserController::class, 'login_create'])->name('login.create');
Route::post('/login', [UserController::class, 'login_store'])->name('login.store');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'register_create'])->name('register.create');
Route::post('/register', [UserController::class, 'register_store'])->name('register.store');

Route::get('/account/{id}', [UserController::class, 'account_show'])->name('account.show');
Route::post('/account/{id}', [UserController::class, 'account_store'])->name('account.store');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/edit', [UserController::class, 'edit_show'])->name('edit.show');
    Route::post('/edit', [UserController::class, 'edit_store'])->name('edit.store');
});

Route::get('/post/{slug}', [PostController::class, 'post_create'])->name('post.create');
Route::post('/post/{slug}', [PostController::class, 'post_store'])->name('post.store');