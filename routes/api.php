<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

// Endpoint test sederhana
Route::apiResource('categories', CategoryController::class);
Route::apiResource('items', ItemController::class);
Route::get('/test', function () {
    
    return response()->json([
        'status' => 'success',
        'message' => 'API endpoint berhasil diakses',
        'data' => [
            'nama' => 'Bayu Alamsyah Pabarani',
            'nim' => '60200124099',
            'matkul' => 'Environment dan Repository'
        ]
    ], 200);
});