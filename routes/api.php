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



// Product Item Management Routes
Route::get('/product-items', [\App\Http\Controllers\API\ProductItemController::class, 'index']);
Route::post('/product-items', [\App\Http\Controllers\API\ProductItemController::class, 'store']);
Route::get('/product-items/{id}', [\App\Http\Controllers\API\ProductItemController::class, 'show']);
Route::put('/product-items/{id}', [\App\Http\Controllers\API\ProductItemController::class, 'update']);
Route::delete('/product-items/{id}', [\App\Http\Controllers\API\ProductItemController::class, 'destroy']);



// Payment Type Management Routes
Route::get('/payment-types', [\App\Http\Controllers\API\PaymentTypeController::class, 'index']);
Route::post('/payment-types', [\App\Http\Controllers\API\PaymentTypeController::class, 'store']);
Route::get('/payment-types/{id}', [\App\Http\Controllers\API\PaymentTypeController::class, 'show']);
Route::put('/payment-types/{id}', [\App\Http\Controllers\API\PaymentTypeController::class, 'update']);
Route::delete('/payment-types/{id}', [\App\Http\Controllers\API\PaymentTypeController::class, 'destroy']);



// Payment Method Management Routes
Route::get('/payment-methods', [\App\Http\Controllers\API\PaymentMethodController::class, 'index']);
Route::post('/payment-methods', [\App\Http\Controllers\API\PaymentMethodController::class, 'store']);
Route::get('/payment-methods/{id}', [\App\Http\Controllers\API\PaymentMethodController::class, 'show']);
Route::put('/payment-methods/{id}', [\App\Http\Controllers\API\PaymentMethodController::class, 'update']);
Route::delete('/payment-methods/{id}', [\App\Http\Controllers\API\PaymentMethodController::class, 'destroy']);



// Shopping Cart Management Routes
Route::get('/shopping-carts', [\App\Http\Controllers\API\ShoppingCartController::class, 'index']);
Route::post('/shopping-carts', [\App\Http\Controllers\API\ShoppingCartController::class, 'store']);
Route::get('/shopping-carts/{id}', [\App\Http\Controllers\API\ShoppingCartController::class, 'show']);
Route::put('/shopping-carts/{id}', [\App\Http\Controllers\API\ShoppingCartController::class, 'update']);
Route::delete('/shopping-carts/{id}', [\App\Http\Controllers\API\ShoppingCartController::class, 'destroy']);



// Shopping Cart Item Management Routes
Route::get('/shopping-cart-items', [\App\Http\Controllers\API\ShoppingCartItemController::class, 'index']);
Route::post('/shopping-cart-items', [\App\Http\Controllers\API\ShoppingCartItemController::class, 'store']);
Route::get('/shopping-cart-items/{id}', [\App\Http\Controllers\API\ShoppingCartItemController::class, 'show']);
Route::put('/shopping-cart-items/{id}', [\App\Http\Controllers\API\ShoppingCartItemController::class, 'update']);
Route::delete('/shopping-cart-items/{id}', [\App\Http\Controllers\API\ShoppingCartItemController::class, 'destroy']);



// Shipping Method Management Routes
Route::get('/shipping-methods', [\App\Http\Controllers\API\ShippingMethodController::class, 'index']);
Route::post('/shipping-methods', [\App\Http\Controllers\API\ShippingMethodController::class, 'store']);
Route::get('/shipping-methods/{id}', [\App\Http\Controllers\API\ShippingMethodController::class, 'show']);
Route::put('/shipping-methods/{id}', [\App\Http\Controllers\API\ShippingMethodController::class, 'update']);
Route::delete('/shipping-methods/{id}', [\App\Http\Controllers\API\ShippingMethodController::class, 'destroy']);
