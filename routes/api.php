<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\RecordTypeController;
use App\Http\Controllers\api\RecordController;
use App\Http\Controllers\api\StatusController;
use App\Http\Controllers\api\TaskController;

Route::middleware(['guest:sanctum'])->controller(AuthController::class)->group(function() {

    Route::post('/signUp', 'signUp');

    Route::post('/signIn', 'signIn');

});

Route::middleware(['auth:sanctum'])->group(function() {

    Route::post('/signOut', [AuthController::class, 'signOut']);

    Route::apiResource('recordTypes', RecordTypeController::class);

    Route::apiResource('records', RecordController::class);

    Route::apiResource('statuses', StatusController::class);

    Route::apiResource('tasks', TaskController::class);

});
