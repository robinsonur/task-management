<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\RecordTypeController;
use App\Http\Controllers\api\RecordController;
use App\Http\Controllers\api\StatusController;
use App\Http\Controllers\api\TaskController;

auth()->loginUsingId(22);

Route::middleware(['guest:sanctum'])
    ->controller(AuthController::class)
    ->group(function() {

        Route::post('/signUp', 'signUp');

        Route::post('/signIn', 'signIn');

    })
;

Route::middleware(['auth:sanctum'])->group(function() {

    Route::post('/signOut', [AuthController::class, 'signOut']);

    Route::resources([
        'users' => UserController::class,
        'recordTypes' => RecordTypeController::class,
        'records' => RecordController::class,
        'statuses' => StatusController::class,
        'tasks' => TaskController::class
    ]);

});
