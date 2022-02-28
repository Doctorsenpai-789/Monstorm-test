<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProductController;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::resource('profile', ProfileController::class);

//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/profile/search/{fullname}', [ProfileController::class, 'search']);
Route::get('/profile/{id}', [ProfileController::class, 'show']);


//Booking routes
Route::get('/book', [BookController::class, 'index']);
Route::get('/book', [BookController::class, 'show']);
Route::resource('/book', BookController::class);
Route::post('/book', [BookController::class, 'store']);
Route::put('/book/{id}', [BookController::class, 'update']);
Route::delete('/book/{id}', [BookController::class, 'destroy']);


//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::post('/profile', [ProfileController::class, 'store']);
  Route::put('/profile/{id}', [ProfileController::class, 'update']);
  Route::delete('/profile/{id}', [ProfileController::class, 'destroy']);
  Route::post('/logout', [AuthController::class, 'logout']);
});


//Product routes
Route::resource('/product', ProductController::class);
Route::get('/product',[ProductController::class, 'index']);
Route::get('/product',[ProductController::class, 'show']);
Route::post('/product', [ProductController::class, 'store']);
Route::put('/profile/{id}', [ProductController::class, 'update']);
Route::delete('/profile/{id}', [ProductController::class, 'destroy']);























// return response()->json([
//     'fullname' => 'Monstorm' ,
//     'email' => 'monstorm@gmail.com',
//     'address' => 'Dalaguete',
//     'phoneNumber' => '09123979022',
//     'password' => "no password",
//     'userTypeID'=> 002,

// ]);

// return Profile::all();

// Route::post('/profile', function () {
//     return Profile::create([
//         'fullname' => 'Monstorm',
//         'email' => 'Monstorm@gmail.com',
//         'address' => 'Dalaguete'
//     ]);
// });
