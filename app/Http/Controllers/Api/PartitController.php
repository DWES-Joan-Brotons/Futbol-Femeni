<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partit;
use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;
use App\Http\Resources\PartitResource;
use App\Http\Resources\PartitCollection;

class PartitController extends Controller
{
    public function index()
    {
        return new PartitCollection(Partit::paginate(10));
    }

    public function store(StorePartitRequest $request)
    {
        $partit = Partit::create($request->validated());
        return response()->json(new PartitResource($partit), 201);
    }

    public function show(Partit $partit)
    {
        return new PartitResource($partit);
    }

    public function update(UpdatePartitRequest $request, Partit $partit)
    {
        $partit->update($request->validated());
        return response()->json(new PartitResource($partit), 200);
    }

    public function destroy(Partit $partit)
    {
        $partit->delete();
        return response()->noContent();
    }
}