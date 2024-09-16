<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'registerUser']);
    Route::post('/login', [AuthController::class, 'loginUser']);
    Route::post('/logout', [AuthController::class, 'logoutUser']);
});

Route::apiResource('students', StudentController::class)->middleware('auth:sanctum');
Route::get('/users', [AuthController::class, 'listUsers'])->middleware('auth:sanctum');
Route::get('/users/{id}', [AuthController::class, 'userProfile'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [AuthController::class, 'deleteUser'])->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});
