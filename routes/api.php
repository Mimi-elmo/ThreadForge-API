<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\BlueprintController;
 use App\Http\Controllers\Api\RawContentController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function() {
    return ["message" => "Hello, AGADIR!"];
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('posts', PostController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('blueprints', BlueprintController::class);

   


Route::middleware('auth:sanctum')->group(function () {

    Route::post(
        '/content/repurpose',
        [RawContentController::class, 'store']
    );

});
});
});