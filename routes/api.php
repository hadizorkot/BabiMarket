<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


// User Management Routes
Route::get('/users', [\App\Http\Controllers\API\UserController::class, 'index']);
Route::post('/users', [\App\Http\Controllers\API\UserController::class, 'store']);
Route::get('/users/{id}', [\App\Http\Controllers\API\UserController::class, 'show']);
Route::put('/users/{id}', [\App\Http\Controllers\API\UserController::class, 'update']);
Route::delete('/users/{id}', [\App\Http\Controllers\API\UserController::class, 'destroy']);


// Address Management Routes
Route::get('/addresses', [\App\Http\Controllers\API\AddressController::class, 'index']);
Route::post('/addresses', [\App\Http\Controllers\API\AddressController::class, 'store']);
Route::get('/addresses/{id}', [\App\Http\Controllers\API\AddressController::class, 'show']);
Route::put('/addresses/{id}', [\App\Http\Controllers\API\AddressController::class, 'update']);
Route::delete('/addresses/{id}', [\App\Http\Controllers\API\AddressController::class, 'destroy']);


