<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Equip;
use App\Models\Partit;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;


class Classificacio extends Component
{

    #[On('echo:classificacio,partit.resultat')]
    #[On('classificacio-refresh')]
    public function refreshFromBroadcast(): void
    {
        // Opció 1: si fas la consulta en render(), n'hi ha prou amb refrescar.
        $this->dispatch('$refresh');

        // Opció 2: si tens un mètode específic, crida'l ací.
        // $this->calcularClassificacio();
    }


    // Variables para controlar la ordenación
    public $sortCol = 'punts'; // Columna por defecto
    public $sortAsc = false;   // Dirección por defecto (Descendente para puntos)

    public function sortBy($column)
    {
        // Si clicamos la misma columna, invertimos la dirección
        if ($this->sortCol === $column) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortCol = $column;
            // Por defecto, puntos y goles van DESC, posición y nombre van ASC
            $this->sortAsc = in_array($column, ['pos', 'nom']) ? true : false;
        }
    }

    public function render()
    {
        $equips = Equip::all();
        $taula = collect();

        foreach ($equips as $equip) {
            $punts = 0; $pj = 0; $pg = 0; $pe = 0; $pp = 0;
            $gf = 0; $gc = 0;
            $historialReciente = collect();

            // Lógica de cálculo (igual que antes)
            $partitsAcabats = Partit::where(function($q) use ($equip) {
                    $q->where('local_id', $equip->id)->orWhere('visitant_id', $equip->id);
                })
                ->whereNotNull('gols_local')
                ->orderBy('data', 'desc')
                ->get();

            foreach ($partitsAcabats as $p) {
                $pj++;
                $esLocal = $p->local_id === $equip->id;
                $golsFavor = $esLocal ? $p->gols_local : $p->gols_visitant;
                $golsContra = $esLocal ? $p->gols_visitant : $p->gols_local;

                $gf += $golsFavor;
                $gc += $golsContra;

                $resultat = 'E';
                if ($golsFavor > $golsContra) {
                    $punts += 3; $pg++; $resultat = 'V';
                } elseif ($golsFavor < $golsContra) {
                    $pp++; $resultat = 'D';
                } else {
                    $punts += 1; $pe++;
                }

                if ($historialReciente->count() < 5) {
                    $historialReciente->push($resultat);
                }
            }

            $taula->push([
                'id' => $equip->id,
                'nom' => $equip->nom,
                'escut' => $equip->escut, // Asegúrate de tener este campo en la BD
                'punts' => $punts,
                'pj' => $pj,
                'pg' => $pg,
                'pe' => $pe,
                'pp' => $pp,
                'gf' => $gf,
                'gc' => $gc,
                'dif' => $gf - $gc,
                'forma' => $historialReciente->reverse()
            ]);
        }

        // --- LÓGICA DE ORDENACIÓN DINÁMICA ---
        $taula = $taula->sort(function ($a, $b) {
            $col = $this->sortCol;
            
            // Valor A y B según la columna seleccionada
            $valA = $a[$col];
            $valB = $b[$col];

            // Ordenación principal
            if ($valA != $valB) {
                return $this->sortAsc ? ($valA <=> $valB) : ($valB <=> $valA);
            }

            // Desempates por defecto (siempre Puntos > Dif > GF)
            if ($a['punts'] !== $b['punts']) return $b['punts'] <=> $a['punts'];
            if ($a['dif'] !== $b['dif']) return $b['dif'] <=> $a['dif'];
            return $b['gf'] <=> $a['gf'];
        });

        return view('livewire.classificacio', ['taula' => $taula]);
    }
}