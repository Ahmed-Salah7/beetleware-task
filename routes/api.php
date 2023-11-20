<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\Auth\Logincontroller;
use App\Http\Controllers\Apis\Auth\LogoutController;
use App\Http\Controllers\Apis\TransactionController;

Route::post('/login',[Logincontroller::class,'login'] );
Route::middleware(['auth:sanctum'])->group( function () {
    Route::get('/logout', [LogoutController::class, 'logout']);
    Route::apiResource('transactions',TransactionController::class)->only(['index','store','show']);
});
