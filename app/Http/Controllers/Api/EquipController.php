<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use App\Http\Resources\EquipResource;
use App\Http\Resources\EquipCollection;

class EquipController extends Controller
{
    public function index()
    {
        return new EquipCollection(Equip::paginate(10));
    }

    public function store(StoreEquipRequest $request)
    {
        return response()->json($request->validated(), 201);
        $equip = Equip::create($request->validated());
        return response()->json(new EquipResource($equip), 201);
    }

    public function show(Equip $equip)
    {
        return new EquipResource($equip);
    }

    public function update(UpdateEquipRequest $request, Equip $equip)
    {
        $equip->update($request->validated());
        return response()->json(new EquipResource($equip), 200);
    }

    public function destroy(Equip $equip)
    {
        $equip->delete();
        return response()->noContent();
    }
}