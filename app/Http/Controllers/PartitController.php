<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PartitController extends Controller
{
    // Dades inicials (seed)
    public $partits = [
        ['local' => 'Barça Femení', 'visitant' => 'Atlètic de Madrid', 'data' => '2024-11-30', 'resultat' => null],
        ['local' => 'Real Madrid Femení', 'visitant' => 'Barça Femení', 'data' => '2024-12-15', 'resultat' => '0-3'],
    ];

    public function index()
    {
        // Clau de sessió: 'partits'
        $partits = Session::get('partits', $this->partits);
        return view('partits.index', compact('partits'));
    }

    public function show(int $id)
    {
        $partits = Session::get('partits', $this->partits);
        abort_if(!isset($partits[$id]), 404);
        
        $partit = $partits[$id];
        return view('partits.show', compact('partit'));
    }

    public function create() 
    { 
        return view('partits.create'); 
    }

    public function store(Request $request)
    {
        // Validació (requisits Fase 3)
        $validated = $request->validate([
            'local' => 'required|min:2',
            'visitant' => 'required|min:2|different:local', // No pot ser igual a 'local'
            'data' => 'required|date_format:Y-m-d', // Format data
            'resultat' => 'nullable|regex:/^\d+-\d+$/', // Nul o format N-N
        ], [
            // Missatges personalitzats
            'visitant.different' => 'L\'equip visitant ha de ser diferent de l\'equip local.',
            'resultat.regex' => 'El format del resultat ha de ser N-N (ex: 2-1, 0-3, etc.).'
        ]);

        $partits = Session::get('partits', $this->partits);
        $partits[] = $validated; // Afegim el nou partit
        Session::put('partits', $partits); // El desem a la sessió

        return redirect()->route('partits.index')->with('success', 'Partit afegit correctament!');
    }
}