<?php

use App\Http\Controllers\UserController;
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
});

/* Login */
Route::get('/login', function () {
    return view('pages.auth.login');
});
Route::post('/login', [UserController::class, 'login']);

/* Register */
Route::get('/register', function () {
    return view('pages.auth.register');
});
Route::post('/register', [UserController::class, 'register']);
