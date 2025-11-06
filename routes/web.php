<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;

Route::get('/', fn() => "Benvingut a la Guia d'Equips de Futbol Femení!");
Route::resource('equips', EquipController::class);