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