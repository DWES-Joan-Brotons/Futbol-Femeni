<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use App\Http\Controllers\EquipController;
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    // Rutas de lectura para todos los autenticados
    Route::resource('estadis', EstadiController::class)->only(['index', 'show']);
    Route::resource('equips', EquipController::class)->only(['index', 'show']);
    Route::resource('partits', PartitController::class);
    Route::resource('jugadores', JugadoraController::class)->parameter('jugadores', 'jugadora');

    // Rutas SOLO para ADMIN (Modificar Equips y Estadis)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('estadis', EstadiController::class)->except(['index', 'show']);
        Route::resource('equips', EquipController::class)->except(['index', 'show']);
    });
});

require __DIR__.'/auth.php';