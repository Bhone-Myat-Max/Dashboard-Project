<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PermissionController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/categories/store', [CategoryController::class , 'store']);
Route::post('/auth/login', [AuthController::class , 'login']);

Route::post('/categories/{id}/update', [CategoryController::class, 'update']);
Route::post('/categories/{id}/delete', [CategoryController::class, 'delete']);


//product
Route::get('/products',[ProductController::class, 'index']);
Route::get('/products/{id}/show',[ProductController::class, 'show']);
Route::post('products/store', [ProductController::class, 'store']);
Route::post('product/{id}/update',[ProductController::class, 'update']);
Route::post('product/{id}/delete',[ProductController::class, 'delete']);


Route::group(['middleware'=> 'auth:api'], function(){
    Route::get('/categories', [CategoryController::class , 'index']);
    Route::get('/categories/{id}', [CategoryController::class , 'show']);
});


Route::apiResource('/permissions', PermissionController::class);


Route::apiResource('/role', RoleController::class);

#User
Route::apiResource('/user', UserController::class);

