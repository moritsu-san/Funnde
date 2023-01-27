<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Answer;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;       
use App\Http\Controllers\ThreadController;       
use App\Http\Controllers\AnswerController;       
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Auth;

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

/*今のところ使わない*/
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/postOdai', [ThreadController::class, 'store'])->name('postOdai');

Route::get('/user', fn() => Auth::user())->name('user');

Route::get('/getOdais', [ThreadController::class, 'index']);

Route::get('/threads/{id}', [ThreadController::class, 'shosai']);

Route::get('/isLiked/{answer}', [AnswerController::class, 'isLiked']);
Route::get('/countLikes/{answer}', [AnswerController::class, 'countLikes']);

Route::put('/{answer}/like', [AnswerController::class, 'like'])->name('like');
Route::delete('/{answer}/like', [AnswerController::class, 'unlike'])->name('unlike');
