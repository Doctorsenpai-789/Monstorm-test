<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::resource('products', ProductController::class);

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/change_password', [AuthController::class, 'change_password']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);

Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::get('/bookings/search/{name}', [BookingController::class, 'search']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //book routes
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::put('/bookings/{id}', [BookingController::class, 'update']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);

    //transcation routes
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::put('/transactions/{id}', [TransactionController::class, 'update']);
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

    //annoucement routes
    // Route::post('/transaction', [TransactionController ::class, 'store']);

});

Route::post('/announcement', [AnnouncementController::class, 'store']);
Route::post('/profiles', [ProfileController::class, 'store']);

//transaction routes
Route::get('/transaction', [TransactionController::class, 'index']);
Route::get('/transaction/{id}', [TransactionController::class, 'show']);
// Route::post('/transaction', [TransactionController ::class, 'store']);
// Route::put('/transaction/{id}', [TransactionController ::class, 'update']);
// Route::delete('/transaction/{id}', [TransactionController ::class, 'destroy']);

//Route::resource('transaction', TransactionController::class);

//resource routes
// Route::resource('bookingtype', BookingTypeController::class);
// Route::resource('usertype', UserTypeController::class);
Route::resource('announcement', AnnouncementController::class);
Route::resource('profiles', ProfileController::class);

// Route::resource('status', StatusController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
