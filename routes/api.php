<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JugadoraController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutes per a l'API de Jugadores
Route::apiResource('jugadores', JugadoraController::class)
    ->parameters(['jugadores' => 'jugadora']);

Route::apiResource('jugadores', \App\Http\Controllers\Api\JugadoraController::class)
    ->parameters(['jugadores' => 'jugadora']);

Route::apiResource('estadis', \App\Http\Controllers\Api\EstadiController::class)
    ->parameters(['estadis' => 'estadi']);

Route::apiResource('equips', \App\Http\Controllers\Api\EquipController::class)
    ->parameters(['equips' => 'equip']);

Route::apiResource('partits', \App\Http\Controllers\Api\PartitController::class)
    ->parameters(['partits' => 'partit']);