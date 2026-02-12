<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use App\Services\EstadiService;
use App\Services\GeminiService; // <--- IMPRESCINDIBLE
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;
use Illuminate\Support\Facades\Cache; // <--- IMPRESCINDIBLE

class EstadiController extends Controller
{
    // Inyectamos el servicio de Gemini
    public function __construct(
        private EstadiService $servei,
        private GeminiService $geminiService
    ) {}

    public function index()
    {
        $estadis = $this->servei->llistar();
        return view('estadis.index', compact('estadis'));
    }

    public function show(Estadi $estadi)
    {
        $estadi->load('equips');

        // Intentamos obtener la descripción de la caché o de la IA
        // Si falla la IA, mostrará el mensaje de error que programamos en el servicio
        $descripcioIA = Cache::remember('desc_estadi_' . $estadi->id, 86400, function () use ($estadi) {
            return $this->geminiService->generarDescripcio($estadi->nom);
        });

        return view('estadis.show', compact('estadi', 'descripcioIA'));
    }

    public function create() { return view('estadis.create'); }

    public function store(StoreEstadiRequest $request)
    {
        $this->servei->guardar($request->validated());
        return redirect()->route('estadis.index')->with('success', 'Estadi creat correctament');
    }

    public function edit(Estadi $estadi) { return view('estadis.edit', compact('estadi')); }

    public function update(UpdateEstadiRequest $request, Estadi $estadi)
    {
        $this->servei->actualitzar($estadi->id, $request->validated());
        Cache::forget('desc_estadi_' . $estadi->id); // Borramos caché al editar
        return redirect()->route('estadis.index')->with('success', 'Estadi actualitzat');
    }

    public function destroy(Estadi $estadi)
    {
        $this->servei->eliminar($estadi->id);
        return redirect()->route('estadis.index')->with('success', 'Estadi eliminat');
    }
}