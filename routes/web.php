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
Route::get('/countries', function () {
    $file = public_path('countries.json');
    return Response::file($file);
});
Route::get('/appartments/createAppartment/{id}',[AppartmentController::class, 'createAppartment']);
Route::get('/orders/canselOrder/{id}',[App\Http\Controllers\OrderController::class, 'canselOrder']);
Route::get('/orders/canselfromOrders/{id}',[App\Http\Controllers\OrderController::class, 'canselfromOrders']);
Route::get('/orders/confirmOrder/{id}',[App\Http\Controllers\OrderController::class, 'confirmOrder']);
Route::get('/orders/closedOrder/{id}',[App\Http\Controllers\OrderController::class, 'closedOrder']);
Route::get('/orders/createOrder/{id}',[OrderController::class, 'create']);
Route::resource('/roles',App\Http\Controllers\RoleController::class);
Route::resource('/users',App\Http\Controllers\UserController::class);
Route::resource('/permissions',App\Http\Controllers\PermissionController::class);
Route::resource('/statuses',App\Http\Controllers\StatusController::class);
Route::resource('/placements',App\Http\Controllers\PlacementController::class);
Route::resource('/appartments',App\Http\Controllers\AppartmentController::class);
Route::resource('/categories',App\Http\Controllers\ComfortCategoryController::class);
Route::resource('/comforts',App\Http\Controllers\ComfortController::class);
Route::resource('/orders',App\Http\Controllers\OrderController::class);
Route::resource('/bookings',App\Http\Controllers\BookingController::class);

Auth::routes();