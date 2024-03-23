<?php

use App\Http\Controllers\AutoController;
use App\Http\Controllers\LocationController;
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

Route::get('/autos', [AutoController::class, 'index'])->name('api.auto.index');
Route::post('/auto', [AutoController::class, 'store'])->name('api.auto.store');
Route::get('/autos/{id}', [AutoController::class, 'show'])->name('api.auto.show');
Route::put('/autos/{id}', [AutoController::class, 'update'])->name('api.auto.update');
Route::delete('/autos/{id}', [AutoController::class, 'destroy'])->name('api.auto.destroy');

Route::get('/locaciones', [LocationController::class, 'index']);
Route::post('/locacion', [LocationController::class, 'store']);
Route::get('/locaciones/{id}', [LocationController::class, 'show']);
Route::put('/locaciones/{id}', [LocationController::class, 'update']);
Route::delete('/locaciones/{id}', [LocationController::class, 'destroy']);

Route::post('/autos/{auto}/assign/{locacion}', [AutoController::class, 'asignarLocacion']);

Route::get('/autos/by-location/{location}', [AutoController::class, 'autosByLocacion']);
