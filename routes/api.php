<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/get/articles', [ApiController::class, 'getArticles']);
Route::post('/get/article', [ApiController::class, 'getArticle']);
// Route::post('/delete/article', [ApiController::class, 'delete']);
Route::post('/delete/article', [ApiController::class, 'deleteArticle']);
// Route::post('/create/article', [ApiController::class, 'create_article']);




Route::post('/get/users', [ApiController::class, 'alluser']);
Route::post('/get/user', [ApiController::class, 'singleuser']);



Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function (Request $request) {
        return auth()->user();
    });
    Route::post('create', [ApiController::class, 'create']);


    Route::post('/auth/logout', [AuthController::class, 'logout']);
});
