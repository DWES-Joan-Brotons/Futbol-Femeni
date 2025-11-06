<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;  // Añadir
use App\Http\Controllers\JugadoraController; // Añadir
use App\Http\Controllers\PartitController;

Route::get('/', fn() => "Benvingut a la Guia d'Equips de Futbol Femení!");
Route::resource('equips', EquipController::class);
Route::resource('estadis', EstadiController::class);
// Rutas para Estadis (Fase 1)


// --- RUTES JUGADORES (FASE 2) ---
Route::get('/jugadores', [JugadoraController::class, 'index'])->name('jugadores.index');
Route::get('/jugadores/crear', [JugadoraController::class, 'create'])->name('jugadores.create');
Route::post('/jugadores', [JugadoraController::class, 'store'])->name('jugadores.store');
Route::get('/jugadores/{id}', [JugadoraController::class, 'show'])->name('jugadores.show');

Route::get('/partits', [PartitController::class, 'index'])->name('partits.index');
Route::get('/partits/crear', [PartitController::class, 'create'])->name('partits.create');
Route::post('/partits', [PartitController::class, 'store'])->name('partits.store');
// També afegim la ruta 'show' per seguir el patró de la teva app
Route::get('/partits/{id}', [PartitController::class, 'show'])->name('partits.show');