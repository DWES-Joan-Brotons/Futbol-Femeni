<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EquipController extends Controller
{
    public $equips = [
        ['nom' => 'Barça Femení',      'estadi' => 'Camp Nou',               'titols' => 30],
        ['nom' => 'Atlètic de Madrid',  'estadi' => 'Cívitas Metropolitano',  'titols' => 10],
        ['nom' => 'Real Madrid Femení', 'estadi' => 'Alfredo Di Stéfano',     'titols' => 5],
    ];

    public function index()
    {
        $equips = Session::get('equips', $this->equips);
        return view('equips.index', compact('equips'));
    }

    public function show(int $id)
    {
        $equips = Session::get('equips', $this->equips);
        abort_if(!isset($equips[$id]), 404);
        $equip = $equips[$id];
        return view('equips.show', compact('equip'));
    }

    public function create() { return view('equips.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'    => 'required|min:3',
            'estadi' => 'required',
            'titols' => 'required|integer|min:0',
        ]);

        $equips = Session::get('equips', $this->equips);
        $equips[] = $validated;
        Session::put('equips', $equips);

        return redirect()->route('equips.index')->with('success', 'Equip afegit correctament!');
    }
}