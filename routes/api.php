<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\StatusController;

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
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);

Route::get('/book', [BookController::class, 'index']);
Route::get('/book/{id}', [BookController::class, 'show']);
Route::get('/book/search/{name}', [BookController::class, 'search']);





// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

});

//book routes
Route::post('/book', [BookController::class, 'store']);
Route::put('/book/{id}', [BookController::class, 'update']);
Route::delete('/book/{id}', [BookController::class, 'destroy']);

//transcation routes
Route::post('/transaction', [TransactionController::class, 'store']);
Route::put('/transaction/{id}', [TransactionController::class, 'update']);
Route::delete('/transaction/{id}', [TransactionController::class, 'destroy']);


//transaction routes
Route::get('/transaction', [TransactionController::class, 'index']);
Route::get('/transaction/{id}', [TransactionController::class, 'show']);
// Route::post('/transaction', [TransactionController ::class, 'store']);
// Route::put('/transaction/{id}', [TransactionController ::class, 'update']);
// Route::delete('/transaction/{id}', [TransactionController ::class, 'destroy']);

//Route::resource('transaction', TransactionController::class);



//resource routes
Route::resource('bookingtype', BookingTypeController::class);
Route::resource('usertype', UserTypeController::class);
Route::resource('announcement', AnnouncementController::class);
Route::resource('status', StatusController::class);

//bookingtype routes
Route::get('/bookingtype', [BookingTypeController::class, 'index']);
Route::get('/bookingtype/{id}', [BookingTypeController::class, 'show']);
Route::post('/bookingtype', [BookingTypeController::class, 'store']);
Route::put('/bookingtype/{id}', [BookingTypeController::class, 'update']);
Route::delete('/bookingtype/{id}', [BookingTypeController::class, 'destroy']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
