<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use App\Services\PartitService;
use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;

class PartitController extends Controller
{
    public function __construct(private PartitService $servei) {}

    public function index()
    {
        $partits = $this->servei->llistar();
        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.create', compact('equips', 'estadis'));
    }

    public function store(StorePartitRequest $request)
    {
        $this->servei->guardar($request->validated());
        return redirect()->route('partits.index')
                        ->with('success', 'Partit creat correctament.');
    }

    public function show(Partit $partit)
    {
        $partit->load('equipLocal', 'equipVisitant', 'estadi');
        return view('partits.show', compact('partit'));
    }

    public function edit(Partit $partit)
    {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.edit', compact('partit', 'equips', 'estadis'));
    }

    public function update(UpdatePartitRequest $request, Partit $partit)
    {
        $this->servei->actualitzar($partit->id, $request->validated());
        PartitActualitzat::dispatch($partit->id);
        return redirect()->route('partits.index')
                        ->with('success', 'Partit actualitzat correctament.');
    }

    public function destroy(Partit $partit)
    {
        $this->servei->eliminar($partit->id);
        return redirect()->route('partits.index')
                        ->with('success', 'Partit eliminat correctament.');
    }

    public function historic()
    {
        return view('partits.historic');
    }
}