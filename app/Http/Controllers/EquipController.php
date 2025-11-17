<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use App\Models\Equip;
use App\Models\Estadi;
use App\Services\EquipService;

class EquipController extends Controller {
    public function __construct(private EquipService $servei) {}

    // GET /equips
    public function index() {
        return view('equips.index', ['equips' => $this->servei->llistar()]);
    }

    // GET /equips/create
    public function create() {
        $estadis = Estadi::all();
        return view('equips.create',compact('estadis'));
    }
    // POST /equips
    public function store(StoreEquipRequest $request) {
        $this->servei->guardar($request->validated());
        return redirect()->route('equips.index')->with('success', 'Equip creat correctament.');
    }

    // GET /equips/{id}
    public function show(Equip $equip) {
        $equip->load('jugadores', 'estadi', 'partitsLocal', 'partitsVisitant');
        return view('equips.show', compact('equip'));
    }

    // GET /equips/{id}/edit
    public function edit(Equip $equip) {
        $estadis = Estadi::all();
        return view('equips.edit', compact('equip', 'estadis'));
    }

    // PUT /equips/{id}
    public function update(UpdateEquipRequest $request, Equip $equip) {
        $this->servei->actualitzar($equip->id, $request->validated());
        return redirect()->route('equips.index')->with('success', 'Equip actualitzat correctament.');
    }

    // DELETE /equips/{id}
    public function destroy(Equip $equip) {
        $this->servei->eliminar($equip->id);
        return redirect()->route('equips.index')->with('success', 'Equip eliminat correctament.');
    }
}