<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/image/all', [ImageController::class, 'all']);

Route::post('/image/create', [ImageController::class, 'create']);

Route::get('/image/{image}', function ($image) {
    return view('show', [ 'image' => $image ]);
});

Route::post('/image/delete/{id}', [ImageController::class, 'delete']);

Route::get('/user/all', [UserController::class, 'all']);

Route::post('/user/create', [UserController::class, 'create']);

Route::post('/user/delete/{id}', [UserController::class, 'delete']);

