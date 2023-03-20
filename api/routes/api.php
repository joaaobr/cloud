<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('image')->group(function () {
    Route::get('/all', [ImageController::class, 'all']);
    
    Route::post('/create', [ImageController::class, 'create']);
    
    Route::get('/{image}', function ($image) {
        return view('show', [ 'image' => $image ]);
    });
    
    Route::post('/delete/{id}', [ImageController::class, 'delete']);
});

Route::prefix('user')->group(function () {
    Route::get('/all', [UserController::class, 'all']);
    
    Route::post('/create', [UserController::class, 'create']);
    
    Route::post('/delete/{id}', [UserController::class, 'delete']);
    
    Route::post('/update/{id}', [UserController::class, 'update']);
});