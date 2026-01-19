<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JugadoraController;
use App\Http\Controllers\Api\EstadiController;
use App\Http\Controllers\Api\EquipController;
use App\Http\Controllers\Api\PartitController;
use App\Http\Controllers\Api\AuthController; // Assegura't d'importar el controlador

// Grup de rutes protegides per Sanctum
Route::middleware('auth:sanctum')->group(function () {
    
    // Ruta sol·licitada: Retorna l'usuari autenticat i els seus rols
    Route::get('/profile', [AuthController::class, 'profile']);
    
    // (Opcional) Si vols mantenir l'estàndard /user però usant el controlador:
    // Route::get('/user', [AuthController::class, 'profile']);
});

// ... la resta de les teves rutes apiResource ...
Route::apiResource('jugadores', JugadoraController::class)
    ->parameters(['jugadores' => 'jugadora']);

Route::apiResource('estadis', EstadiController::class)
    ->parameters(['estadis' => 'estadi']);

Route::apiResource('equips', EquipController::class)
    ->parameters(['equips' => 'equip']);

Route::apiResource('partits', PartitController::class)
    ->parameters(['partits' => 'partit']);