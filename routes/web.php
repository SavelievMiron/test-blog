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

    Route::get('/dashboard/posts/create', function () {
        return view('pages.dashboard.posts.create');
    })->name('dashboard.posts.create');
    Route::post('/dashboard/posts/create', [PostController::class, 'create']);

    Route::get('/dashboard/posts/{id}/edit/', function () {
        return view('pages.dashboard.posts.create');
    })->name('dashboard.posts.edit')->where('id', '[0-9]+');
    Route::post('/dashboard/posts/create', [PostController::class, 'edit']);
});

/** --------------------------------------------- /
 *  -------------------- Blog ------------------- /
 * --------------------------------------------- */

Route::get('/blog/{slug}', function (string $slug) {
    $post = Post::where('slug', $slug)->first();

    abort_if(is_null($post), 404);

    return view('blog.post', ['post' => $post]);
})->name('blog.post')->where('slug', '[a-z]+');
