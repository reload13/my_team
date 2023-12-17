<?php

use App\Http\Controllers\GameCRUDController;
use App\Http\Controllers\PlayerCRUDController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamsCrudController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::resource('teams', TeamsCrudController::class);
    Route::resource('players', PlayerCrudController::class);
    Route::resource('matches', GameCrudController::class);
});

// Routes for simple users with read-only access
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('teams', TeamsCrudController::class)->only(['index', 'show']);
    Route::resource('players', PlayerCrudController::class)->only(['index', 'show']);
    Route::resource('matches', GameCrudController::class)->only(['index', 'show']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
