<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TimeLogController;
use App\Http\Controllers\API\UserAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserAuthController::class, 'register'])->name('api.register');
Route::post('/login', [UserAuthController::class, 'login'])->name('api.login');

Route::post('/project/create', [ProjectController::class, 'store'])->name('api.project.create');

Route::post('/project/start-time', [TimeLogController::class , 'start'])->name('api.time-logs.start');
Route::post('/project/stop-time', [TimeLogController::class , 'stop'])->name('api.time-logs.stop');