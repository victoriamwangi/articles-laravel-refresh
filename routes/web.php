<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('home');
});


Auth::routes();

// Route::resource('/articles', ArticlesController::class);
Route::get('/', [ArticlesController::class, 'index'])->name('articles');


Route::middleware(['auth'])->group(function () {
    Route::resource('/articles', ArticlesController::class)->except('index');
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::post('/users/change-role', [UsersController::class, 'change_role']);
    Route::get('/dashboard', [HomeController::class, 'home']);
    // Route::get('/dashboard', [Controller::class, 'dashboard']);
});
