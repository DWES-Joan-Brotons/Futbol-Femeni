<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use App\Http\Controllers\EquipController;
use Illuminate\Support\Facades\Session;


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

    // Rutas accesibles per tothom autenticat (la Policy filtra permisos específics)
    Route::resource('equips', EquipController::class); // <--- MOGUT AQUÍ
    
    // Rutas de lectura/escriptura generals
    Route::resource('partits', PartitController::class);
    Route::resource('jugadores', JugadoraController::class)->parameter('jugadores', 'jugadora');
    
    // Lectura per estadis
    Route::resource('estadis', EstadiController::class)->only(['index', 'show']);

    // Rutas SOLO para ADMIN
    Route::middleware(['role:admin'])->group(function () {
        // Només l'admin pot modificar estadis
        Route::resource('estadis', EstadiController::class)->except(['index', 'show']);
    });
});
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es', 'ca'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('language.switch');

require __DIR__.'/auth.php';