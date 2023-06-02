<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
//Route::get('/', [NewsController::class,'index']);
Route::get('/', [HomeController::class,'index']);
//Route::get('/', [HomeController::class,'welcome']);
//Route::get('/', [LoginController::class,'login']);
Route::resource('/News',NewsController::class);
Route::resource("Comment", CommentController::class);
//Route::resource('/News',NewsController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
