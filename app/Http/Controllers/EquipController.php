<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use App\Models\Equip;
use App\Models\Estadi;
use App\Services\EquipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        return redirect()->route('equips.index');
    }

    // GET /equips/{id}
    public function show(Equip $equip) {
        return view('equips.show', compact('equip'));
    }

    // GET /equips/{id}/edit
    public function edit(Equip $equip) {
        return view('equips.edit', compact('equip'));
    }

    // PUT /equips/{id}/edit
    public function update(Request $request, Equip $equip) {
        $this->servei->actualitzar($equip, $request->validated());
        return redirect()->route('equips.index')->with('ok', 'Equip actualitzat');
    }




    // DELETE /equips/{id}
    public function destroy($id) {
        $this->servei->eliminar($id);
        return redirect()->route('equips.index');
    }
}




