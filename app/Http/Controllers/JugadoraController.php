<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use App\Services\JugadoraService;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JugadoraController extends Controller
{
    use AuthorizesRequests; // Importante si no está en el Controller base

    public function __construct(private JugadoraService $servei) 
    {
        // Esto activa la seguridad automática basada en JugadoraPolicy
        $this->authorizeResource(Jugadora::class, 'jugadora');
    }

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
        return redirect()->route('jugadores.index')->with('success', 'Jugadora creada.');
    }

    public function show(Jugadora $jugadora)
    {
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
        return redirect()->route('jugadores.index')->with('success', 'Actualitzada.');
    }

    public function destroy(Jugadora $jugadora)
    {
        $this->servei->eliminar($jugadora->id);
        return redirect()->route('jugadores.index')->with('success', 'Eliminada.');
    }
}