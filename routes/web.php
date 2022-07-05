<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
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

/* Homepage */
Route::get('/', function () {
    return view('index');
})->name('home');

/** --------------------------------------------- /
 *  --------------- Authorization --------------- /
 * ---------------------------------------------- */

Route::middleware('guest')->group(function () {
    /* Login */
    Route::get('/login', function () {
        return view('pages.auth.login');
    })->name('login');
    Route::post('/login', [UserController::class, 'login']);

    /* Register */
    Route::get('/register', function () {
        return view('pages.auth.register');
    })->name('register');
    Route::post('/register', [UserController::class, 'register']);

    /* Reset Password */
    Route::get('/forgot-password', function () {
        return view('pages.auth.reset-password');
    })->name('forgot-password');
    Route::post('/forgot-password', [UserController::class, 'resetPassword']);
});

/* Logout */
Route::get('/logout', [UserController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/** --------------------------------------------- /
 *  -------------------- Pages ------------------ /
 * ---------------------------------------------- */

/* Dashboard */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/posts/create', [PostController::class, 'create'])->name('dashboard.posts.create');
    Route::post('/dashboard/posts/create', [PostController::class, 'store']);

    Route::get('/dashboard/posts/{post}/edit/', [PostController::class, 'edit'])->name('dashboard.posts.edit')
         ->where('post', '[0-9]+');
    Route::post('/dashboard/posts/{post}/edit/', [PostController::class, 'update'])
        ->where('post', '[0-9]+');
});

/** --------------------------------------------- /
 *  -------------------- Blog ------------------- /
 * --------------------------------------------- */

Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.post')->where('slug', '[a-z]+');
