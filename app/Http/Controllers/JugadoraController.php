<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Important!

class JugadoraController extends Controller
{
    // Dades inicials (seed)
    public $jugadores = [
        ['nom' => 'Alexia Putellas', 'equip' => 'Barça Femení', 'posicio' => 'Migcampista'],
        ['nom' => 'Esther González', 'equip' => 'Atlètic de Madrid', 'posicio' => 'Davantera'],
        ['nom' => 'Misa Rodríguez', 'equip' => 'Real Madrid Femení', 'posicio' => 'Portera'],
    ];

    // Opcions pel <select> (requisist Fase 2)
    public $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];

    public function index()
    {
        // Clau de sessió: 'jugadores'
        $jugadores = Session::get('jugadores', $this->jugadores);
        return view('jugadores.index', compact('jugadores'));
    }

    public function show(int $id)
    {
        $jugadores = Session::get('jugadores', $this->jugadores);
        // Comprovem si l'índex (ID) existeix
        abort_if(!isset($jugadores[$id]), 404);
        
        $jugadora = $jugadores[$id];
        return view('jugadores.show', compact('jugadora'));
    }

    public function create() 
    { 
        // Passem les opcions de posició a la vista 'create'
        $posicions = $this->posicions;
        return view('jugadores.create', compact('posicions')); 
    }

    public function store(Request $request)
    {
        // Validació (requisits Fase 2)
        $validated = $request->validate([
            'nom' => 'required|min:3',
            'equip' => 'required|min:2',
            // Validació 'in' per al select
            'posicio' => 'required|in:' . implode(',', $this->posicions), 
        ]);

        $jugadores = Session::get('jugadores', $this->jugadores);
        $jugadores[] = $validated; // Afegim la nova jugadora
        Session::put('jugadores', $jugadores); // La desem a la sessió

        return redirect()->route('jugadores.index')->with('success', 'Jugadora afegida correctament!');
    }
}