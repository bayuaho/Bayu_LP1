<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController; 
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::prefix('v1')->group(function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::apiResource('categories', CategoryController::class)
            ->except(['destroy']);

        Route::delete(
            'categories/{category}',
            [CategoryController::class, 'destroy']
        )->middleware('role:admin');

        Route::apiResource('items', ItemController::class)
            ->except(['destroy']);

        Route::delete(
            'items/{item}',
            [ItemController::class, 'destroy']
        )->middleware('role:admin');
    });

});