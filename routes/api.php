<?php

use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserAuthController::class, 'register'])->name('api.register');
Route::post('/login', [UserAuthController::class, 'login'])->name('api.login');

Route::post('/project/start-time', [ProjectController::class , 'start'])->name('api.time-logs.start');
Route::post('/project/stop-time', [ProjectController::class , 'stop'])->name('api.time-logs.stop');