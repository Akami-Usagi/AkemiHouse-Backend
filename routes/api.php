<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; //dependiendo del controlador a usar
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;


//controladores de usuario
Route::get("/users", [UserController::class, "index"]);
Route::get("/users/{id}", [UserController::class, "show"]);
Route::post("/users/", [UserController::class, "store"]);
Route::put("/users/{id}", [UserController::class, "update"]);
Route::delete("/users/{id}", [UserController::class, "destroy"]);


//controladores de producto
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

//controladores de categoria
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

//controladores de imagen
Route::post('/images', [ImageController::class, 'store']);
Route::get('/images/{id}', [ImageController::class, 'show']);
Route::delete('/images/{id}', [ImageController::class, 'destroy']);


// controlador por defecto
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
