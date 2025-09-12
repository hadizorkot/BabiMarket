<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\UserAddressController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


// User Management Routes
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);


// Address Management Routes
Route::get('/addresses', [AddressController::class, 'index']);
Route::post('/addresses', [AddressController::class, 'store']);
Route::get('/addresses/{id}', [AddressController::class, 'show']);
Route::put('/addresses/{id}', [AddressController::class, 'update']);
Route::delete('/addresses/{id}', [AddressController::class, 'destroy']);


// User Address Management Routes
Route::get('/user-addresses', [UserAddressController::class, 'index']);
Route::post('/user-addresses', [UserAddressController::class, 'store']);
Route::get('/user-addresses/{id}', [UserAddressController::class, 'show']);
Route::put('/user-addresses/{id}', [UserAddressController::class, 'update']);
Route::delete('/user-addresses/{id}', [UserAddressController::class, 'destroy']);


// Promotion Management Routes
Route::get('/promotions', [\App\Http\Controllers\API\PromotionController::class, 'index']);
Route::post('/promotions', [\App\Http\Controllers\API\PromotionController::class, 'store']);
Route::get('/promotions/{id}', [\App\Http\Controllers\API\PromotionController::class, 'show']);
Route::put('/promotions/{id}', [\App\Http\Controllers\API\PromotionController::class, 'update']);
Route::delete('/promotions/{id}', [\App\Http\Controllers\API\PromotionController::class, 'destroy']);


// Promotion Category Management Routes
Route::get('/promotion-categories', [\App\Http\Controllers\API\PromotionCategoryController::class, 'index']);
Route::post('/promotion-categories', [\App\Http\Controllers\API\PromotionCategoryController::class, 'store']);
Route::get('/promotion-categories/{id}', [\App\Http\Controllers\API\PromotionCategoryController::class, 'show']);
Route::put('/promotion-categories/{id}', [\App\Http\Controllers\API\PromotionCategoryController::class, 'update']);
Route::delete('/promotion-categories/{id}', [\App\Http\Controllers\API\PromotionCategoryController::class, 'destroy']);



// Product Management Routes
Route::get('/products', [\App\Http\Controllers\API\ProductController::class, 'index']);
Route::post('/products', [\App\Http\Controllers\API\ProductController::class, 'store']);
Route::get('/products/{id}', [\App\Http\Controllers\API\ProductController::class, 'show']);
Route::put('/products/{id}', [\App\Http\Controllers\API\ProductController::class, 'update']);
Route::delete('/products/{id}', [\App\Http\Controllers\API\ProductController::class, 'destroy']);


// Product Category Management Routes
Route::get('/product-categories', [\App\Http\Controllers\API\ProductCategoryController::class, 'index']);
Route::post('/product-categories', [\App\Http\Controllers\API\ProductCategoryController::class, 'store']);
Route::get('/product-categories/{id}', [\App\Http\Controllers\API\ProductCategoryController::class, 'show']);
Route::put('/product-categories/{id}', [\App\Http\Controllers\API\ProductCategoryController::class, 'update']);
Route::delete('/product-categories/{id}', [\App\Http\Controllers\API\ProductCategoryController::class, 'destroy']); 
