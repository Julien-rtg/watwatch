<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProviderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("media")->group(function() {
    Route::get("/", [MediaController::class, 'index']);
    Route::get("/{id}", [MediaController::class, 'show']);

    Route::post("/", [MediaController::class, 'store']);
    Route::put("/{id}", [MediaController::class, 'update']);
    Route::delete("/{id}", [MediaController::class, 'destroy']);

    Route::post("/getMediaByGenreAndProvider", [MediaController::class, 'getMediaByGenreAndProvider']);
});
Route::prefix("provider")->group(function() {
    Route::get("/", [ProviderController::class, 'index']);
});
Route::prefix("genre")->group(function() {
    Route::get("/", [GenreController::class, 'index']);
});