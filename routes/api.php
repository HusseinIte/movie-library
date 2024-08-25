<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;


// ********  Auth Route *********
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

// *****  Movie Route ********
Route::apiResource('movies', MovieController::class);

// ******* Rating Route with Authentication  **********
Route::middleware('auth:sanctum')->group(function () {
    Route::post('movies/{movie}/ratings', [RatingController::class, 'store']);
    Route::put('ratings/{rating}', [RatingController::class, 'update']);
    Route::delete('ratings/{rating}', [RatingController::class, 'destroy']);
//    show rating's movies  by auth user
    Route::get('user/ratings', [RatingController::class, 'showRatingByUser']);
});
//    Rout Rating without Auth
Route::get('ratings/{id}', [RatingController::class, 'showById']);
Route::get('ratings', [RatingController::class, 'getAll']);
//        show rating's movie
Route::get('movies/{id}/ratings', [RatingController::class, 'showRatingByMovie']);

