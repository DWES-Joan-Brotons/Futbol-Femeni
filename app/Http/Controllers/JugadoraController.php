<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class JugadoraController extends Controller
{
    public $jugadores = [
        ['id' => 1, 'nom' => 'Alexia Putellas', 'equip' => 'Barça Femení', 'posicio' => 'Migcampista'],
        ['id' => 2, 'nom' => 'Esther González', 'equip' => 'Atlètic de Madrid', 'posicio' => 'Davantera'],
        ['id' => 3, 'nom' => 'Misa Rodríguez', 'equip' => 'Real Madrid Femení', 'posicio' => 'Portera'],
    ];

    public function index() 
    {
        $jugadores = Session::get('jugadores', $this->jugadores);
        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];
        return view('jugadores.create', compact('posicions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|min:3',
            'equip' => 'required|string|min:2',
            'posicio' => ['required', Rule::in(['Portera', 'Defensa', 'Migcampista', 'Davantera'])],
        ]);

        $jugadores = Session::get('jugadores', $this->jugadores);

        $jugadores[] = $validated;
        Session::put('jugadores', $jugadores);

        return redirect()->route('jugadores.index')
                        ->with('success', 'Jugadora creada correctament.');
    }

    public function show(int $id)
    {
        $jugadores = Session::get('jugadores', $this->jugadores);

        abort_if(!isset($jugadores[$id]), 404, 'Jugadora no trobada');
        
        $jugadora = $jugadores[$id];
        
        return view('jugadores.show', compact('jugadora'));
    }
}