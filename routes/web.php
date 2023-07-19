<?php

use App\Http\Controllers\AppartmentController;
use App\Http\Controllers\PlacementController;
use App\Models\Placement;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $placements = Placement::all();
    return view('home', compact('placements'));
});
Route::get('/appartments/createAppartment/{id}',[AppartmentController::class, 'createAppartment']);
Route::get('/orders/createOrder/{id}',[OrderController::class, 'createOrder']);
//Route::get('/placements/createAppartment',[PlacementController::class, 'createAppartment']);
//Route::resource('placements.appartments', AppartmentController::class);
Route::resource('/roles',App\Http\Controllers\RoleController::class);
Route::resource('/users',App\Http\Controllers\UserController::class);
Route::resource('/permissions',App\Http\Controllers\PermissionController::class);
Route::resource('/statuses',App\Http\Controllers\StatusController::class);
Route::resource('/placements',App\Http\Controllers\PlacementController::class);
Route::resource('/appartments',App\Http\Controllers\AppartmentController::class);
//////////
Route::resource('/categories',App\Http\Controllers\ComfortCategoryController::class);
Route::resource('/comforts',App\Http\Controllers\ComfortController::class);
Route::resource('/comforts',App\Http\Controllers\ComfortController::class);
Route::resource('/orders',App\Http\Controllers\OrderController::class);
Route::resource('/bookings',App\Http\Controllers\BookingController::class);
//Route::get('/categories',[ComfortCategoryController::class, 'index']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
