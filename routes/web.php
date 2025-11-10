<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use App\Http\Controllers\EquipController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('estadis', EstadiController::class);
Route::resource('jugadores', JugadoraController::class);
Route::resource('partits', PartitController::class);
Route::resource('equips', EquipController::class);