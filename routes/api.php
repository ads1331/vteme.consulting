<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;



Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::put('{user}', [UserController::class, 'update']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/', [UserController::class, 'index']);
    Route::delete('{user}', [UserController::class, 'destroy']);
    Route::post('{user}/add-to-group', [UserController::class, 'addToGroup']);
    Route::post('{user}/remove-from-group', [UserController::class, 'removeFromGroup']);
});

Route::prefix('groups')->group(function () {
    Route::post('/', [GroupController::class, 'store']);
    Route::put('{group}', [GroupController::class, 'update']);
    Route::get('{id}', [GroupController::class, 'show']);
    Route::get('/', [GroupController::class, 'index']);
    Route::delete('{group}', [GroupController::class, 'destroy']);
});


