<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estadi;
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;
use App\Http\Resources\EstadiResource;
use App\Http\Resources\EstadiCollection;

class EstadiController extends Controller
{
    public function index()
    {
        return new EstadiCollection(Estadi::paginate(10));
    }

    public function store(StoreEstadiRequest $request)
    {
        $estadi = Estadi::create($request->validated());
        return response()->json(new EstadiResource($estadi), 201);
    }

    public function show(Estadi $estadi)
    {
        return new EstadiResource($estadi);
    }

    public function update(UpdateEstadiRequest $request, Estadi $estadi)
    {
        $estadi->update($request->validated());
        return response()->json(new EstadiResource($estadi), 200);
    }

    public function destroy(Estadi $estadi)
    {
        $estadi->delete();
        return response()->noContent();
    }
}