<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JugadoraController;
use App\Http\Controllers\Api\EstadiController;
use App\Http\Controllers\Api\EquipController;
use App\Http\Controllers\Api\PartitController;
use App\Http\Controllers\Api\AuthController; 

// RUTES PÚBLIQUES D'AUTENTICACIÓ
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// RUTES PROTEGIDES (Token necessari)
Route::middleware('auth:sanctum')->group(function () {
    
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);

    // Perfil (Retorna usuari i rol)
    Route::get('/profile', [AuthController::class, 'profile']);
    
    // (Opcional) També pots mantenir /user si ho prefereixes
    Route::get('/user', [AuthController::class, 'profile']);
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