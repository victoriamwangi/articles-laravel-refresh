<?php

use App\Http\Controllers\ArticlesController;
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
Route::get('/articles', [ArticlesController::class, 'index'])->name('articles');

Route::middleware(['auth'])->group(function () {
    Route::resource('/articles', ArticlesController::class)->except('index');
});
