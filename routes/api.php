<?php

use App\Http\Controllers\Authcontroller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [Authcontroller::class, 'login']);
Route::post('/register', [Authcontroller::class, 'register']);


//Route::get('tasks', [TaskController::class, 'index']);
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('tasks', TaskController::class);
});

