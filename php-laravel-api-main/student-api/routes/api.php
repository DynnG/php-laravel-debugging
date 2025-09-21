<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\StudentController;

// Route::apiResource('students', StudentController::class);


Route::get('/test-log', function () {
    Log::info("✅ Logging is working!");
    return "Check storage/logs/laravel.log";
});

Route::get('/students', [StudentController::class, 'index']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/update/{id}', [StudentController::class, 'update']);
Route::delete('/delete/{id}', [StudentController::class, 'destroy']);


