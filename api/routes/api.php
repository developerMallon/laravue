<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return response()->json(['origem' => 'Intranet Mallon Concessionária.']);
});
Route::get('all', [\App\Http\Controllers\AuthController::class, 'all']);

Route::prefix('v1')->group(function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::get('verify-email', [\App\Http\Controllers\AuthController::class, 'verifyEmail']);
    Route::post('forgot-password', [\App\Http\Controllers\AuthController::class, 'forgotPassword']);
    Route::get('reset-password', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    
    Route::prefix('me')->group(function () {
        Route::get('', [\App\Http\Controllers\MeController::class, 'index']);
        Route::put('', [\App\Http\Controllers\MeController::class, 'update']);
    });

    Route::prefix('todos')->group(function () {
        Route::get('', [\App\Http\Controllers\TodoController::class, 'index']);
        Route::get('{todo}', [\App\Http\Controllers\TodoController::class, 'show']);
        Route::post('', [\App\Http\Controllers\TodoController::class, 'store']);
        Route::put('{todo}', [\App\Http\Controllers\TodoController::class, 'update']);
        Route::delete('{todo}', [\App\Http\Controllers\TodoController::class, 'destroy']);
        Route::post('{todo}/tasks', [\App\Http\Controllers\TodoController::class, 'addTask']);
    });

    Route::prefix('todo-tasks')->group(function () {
        Route::put('{todoTask}', [\App\Http\Controllers\TodoTaskController::class, 'update']);
        Route::delete('{todoTask}', [\App\Http\Controllers\TodoTaskController::class, 'destroy']);
    });
});
