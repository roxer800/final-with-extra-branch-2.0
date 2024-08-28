<?php

use App\Http\Controllers\Api\AdminPanelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/test', [AdminPanelController::class, 'index']);
Route::middleware('auth:sanctum')->get('/admin/{id}', [AdminPanelController::class, 'show']);

Route::middleware('auth:sanctum')->post('/token', [ProfileController::class, 'auth']);
