<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PartitController extends Controller
{
    public $partits = [
        ['id' => 1, 'local' => 'Barça Femení', 'visitant' => 'Atlètic de Madrid', 'data' => '2024-11-30', 'resultat' => null],
        ['id' => 2, 'local' => 'Real Madrid Femení', 'visitant' => 'Barça Femení', 'data' => '2024-12-15', 'resultat' => '0-3'],
    ];

    public function index()
    {
        $partits = Session::get('partits', $this->partits);
        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        return view('partits.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'visitant.different' => 'L\'equip visitant ha de ser diferent de l\'equip local.',
            'resultat.regex' => 'El format del resultat ha de ser N-N (ex. 2-1).',
        ];

        $validated = $request->validate([
            'local' => 'required|string|min:2',
            'visitant' => 'required|string|min:2|different:local',
            'data' => 'required|date_format:Y-m-d',
            'resultat' => 'nullable|regex:/^\d+-\d+$/',
        ], $messages);

        $partits = Session::get('partits', $this->partits);

        $partits[] = $validated;
        Session::put('partits', $partits);

        return redirect()->route('partits.index')
                        ->with('success', 'Partit creat correctament.');
    }

    public function show(int $id)
    {
        $partits = Session::get('partits', $this->partits);

        abort_if(!isset($partits[$id]), 404, 'Partit no trobat');
        
        $partit = $partits[$id];
        
        return view('partits.show', compact('partit'));
    }
}