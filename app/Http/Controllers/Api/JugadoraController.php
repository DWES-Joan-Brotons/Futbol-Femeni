<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jugadora;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;
use App\Http\Resources\JugadoraResource;
use Illuminate\Http\Request;
use App\Http\Resources\JugadoraCollection;

class JugadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retornem paginació com suggereix l'exercici (10 per pàgina)
        return new JugadoraCollection(Jugadora::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJugadoraRequest $request)
    {
        // Creem la jugadora amb les dades validades pel teu Request
        $jugadora = Jugadora::create($request->validated());

        // Retornem el recurs creat amb codi 201
        return response()->json(new JugadoraResource($jugadora), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jugadora $jugadora)
    {
        // Retornem la jugadora específica
        return new JugadoraResource($jugadora);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJugadoraRequest $request, Jugadora $jugadora)
    {
        // Actualitzem amb les dades validades
        $jugadora->update($request->validated());

        // Retornem la jugadora actualitzada amb codi 200
        return response()->json(new JugadoraResource($jugadora), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jugadora $jugadora)
    {
        $jugadora->delete();

        // Retornem 204 (No Content)
        return response()->noContent();
    }
}