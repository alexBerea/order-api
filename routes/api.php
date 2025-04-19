<?php

use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;


Route::middleware([HandleCors::class])->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/orders/store', [OrderController::class, 'store']);
        Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/orders/search', [OrderController::class, 'search']);
        Route::post('/orders/{id}', [OrderController::class, 'update']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

