<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use App\Services\JugadoraService;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;

class JugadoraController extends Controller
{
    public function __construct(private JugadoraService $servei) {}

    public function index() 
    {
        $jugadores = $this->servei->llistar();
        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $equips = Equip::all();
        $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];
        return view('jugadores.create', compact('posicions', 'equips'));
    }

    public function store(StoreJugadoraRequest $request)
    {
        $this->servei->guardar($request->validated());
        return redirect()->route('jugadores.index')
                        ->with('success', 'Jugadora creada correctament.');
    }

    public function show(Jugadora $jugadora)
    {
        $jugadora->load('equip');
        return view('jugadores.show', compact('jugadora'));
    }

    public function edit(Jugadora $jugadora)
    {
        $equips = Equip::all();
        $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];
        return view('jugadores.edit', compact('jugadora', 'equips', 'posicions'));
    }

    public function update(UpdateJugadoraRequest $request, Jugadora $jugadora)
    {
        $this->servei->actualitzar($jugadora->id, $request->validated());
        return redirect()->route('jugadores.index')
                        ->with('success', 'Jugadora actualitzada correctament.');
    }

    public function destroy(Jugadora $jugadora)
    {
        $this->servei->eliminar($jugadora->id);
        return redirect()->route('jugadores.index')
                        ->with('success', 'Jugadora eliminada correctament.');
    }
}