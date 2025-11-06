<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Important!

class EstadiController extends Controller
{
    // Dades inicials (seed)
    public $estadis = [
        ['nom' => 'Estadi Johan Cruyff', 'ciutat' => 'Sant Joan Despí', 'capacitat' => 6000, 'equip_principal' => 'FC Barcelona Femení'],
        ['nom' => 'Centro Deportivo Wanda Alcalá de Henares', 'ciutat' => 'Alcalá de Henares', 'capacitat' => 2800, 'equip_principal' => 'Atlètic de Madrid Femení'],
        ['nom' => 'Estadio Alfredo Di Stéfano', 'ciutat' => 'Madrid', 'capacitat' => 6000, 'equip_principal' => 'Real Madrid Femení'],
    ];

    public function index()
    {
        // Clau de sessió: 'estadis'
        $estadis = Session::get('estadis', $this->estadis);
        return view('estadis.index', compact('estadis'));
    }

    public function show(int $id)
    {
        $estadis = Session::get('estadis', $this->estadis);
        // Comprovem si l'índex (ID) existeix
        abort_if(!isset($estadis[$id]), 404);
        
        $estadi = $estadis[$id];
        return view('estadis.show', compact('estadi'));
    }

    public function create() 
    { 
        return view('estadis.create'); 
    }

    public function store(Request $request)
    {
        // Validació (requisits Fase 1)
        $validated = $request->validate([
            'nom' => 'required|min:3',
            'ciutat' => 'required|min:2',
            'capacitat' => 'required|integer|min:0',
            'equip_principal' => 'required|min:3',
        ]);

        $estadis = Session::get('estadis', $this->estadis);
        $estadis[] = $validated; // Afegim el nou estadi
        Session::put('estadis', $estadis); // El desem a la sessió

        return redirect()->route('estadis.index')->with('success', 'Estadi afegit correctament!');
    }
}