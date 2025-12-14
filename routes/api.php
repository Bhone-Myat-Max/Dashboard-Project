<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/categories/store', [CategoryController::class , 'store']);
Route::post('/auth/login', [AuthController::class , 'login']);
Route::get('/categories', [CategoryController::class , 'index']);
Route::get('/categories/{id}', [CategoryController::class , 'show']);
Route::post('/categories/{id}/update', [CategoryController::class, 'update']);
Route::post('/categories/{id}/delete', [CategoryController::class, 'delete']);


//product
Route::get('/products',[ProductController::class, 'index']);
Route::get('/products/{id}/show',[ProductController::class, 'show']);
Route::post('products/store', [ProductController::class, 'store']);
Route::post('product/{id}/update',[ProductController::class, 'update']);
Route::post('product/{id}/delete',[ProductController::class, 'delete']);
