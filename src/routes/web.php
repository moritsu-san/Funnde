<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Admin;
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

//フロント
Route::get('/', [ThreadController::class, 'index']);
Auth::routes();
Route::resource('/threads', ThreadController::class)->except(['create', 'update']);
Route::resource('threads/{thread}/answers', AnswerController::class)->except(['create', 'update']);

//管理画面
Route::group(['prefix' => 'admin'], function() {
    Route::get('login', [Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [Admin\LoginController::class, 'login']);
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin', 'as' => 'admin.'], function () {
    Route::post('logout', [Admin\LoginController::class, 'logout'])->name('logout');
    Route::resource('threads', Admin\ThreadController::class)->except(['create', 'store', 'update']);
    Route::resource('threads/{thread}/answers', Admin\AnswerController::class)->only('destroy');
});
