<?php

use App\Http\Controllers\AutoController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/assignations', function () {
    return Inertia::render('Assignations');
})->name('assignations');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auto/create', [AutoController::class, 'create'])->name('auto.create');
Route::get('/auto/edit/{id}', [AutoController::class, 'edit'])->name('auto.edit');

Route::post('/auto', [AutoController::class, 'storeView'])->name('auto.store');
Route::put('/autos/{id}', [AutoController::class, 'updateView'])->name('auto.update');
Route::delete('/autos/{id}', [AutoController::class, 'destroyView'])->name('auto.destroy');

Route::post('/asignar', [LocationController::class, 'assignationStore'])->name('assignation.store');

require __DIR__.'/auth.php';
