<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Equip;
use App\Models\Partit;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Classificacio extends Component
{
    // Variables para controlar la ordenación visual
    public $sortCol = 'punts'; 
    public $sortAsc = false;   

    // PROPIETAT CLAU: Per guardar les posicions anteriors [equip_id => posició]
    public $ranquingAnterior = [];

    #[On('echo:classificacio,partit.resultat')]
    #[On('classificacio-refresh')]
    public function refreshFromBroadcast(): void
    {
        $this->dispatch('$refresh');
    }

    public function sortBy($column)
    {
        if ($this->sortCol === $column) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortCol = $column;
            // Per defecte, punts/gols DESC, pos/nom ASC
            $this->sortAsc = in_array($column, ['pos', 'nom']) ? true : false;
        }
    }

    public function render()
    {
        $equips = Equip::all();
        $taula = collect();

        // 1. CÀLCUL DE DADES
        foreach ($equips as $equip) {
            $punts = 0; $pj = 0; $pg = 0; $pe = 0; $pp = 0;
            $gf = 0; $gc = 0;
            $historialReciente = collect();

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
                'escut' => $equip->escut,
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

        // 2. ORDENACIÓ
        $taula = $taula->sort(function ($a, $b) {
            $col = $this->sortCol;
            $valA = $a[$col];
            $valB = $b[$col];

            if ($valA != $valB) {
                return $this->sortAsc ? ($valA <=> $valB) : ($valB <=> $valA);
            }

            if ($a['punts'] !== $b['punts']) return $b['punts'] <=> $a['punts'];
            if ($a['dif'] !== $b['dif']) return $b['dif'] <=> $a['dif'];
            return $b['gf'] <=> $a['gf'];
        });

        // 3. LOGICA DE CANVI DE POSICIÓ (Detectar Pujada/Baixada)
        $taulaOrdenada = $taula->values(); // Reindexar 0,1,2...
        $nouRanquing = [];
        $hiHaCanvis = false;

        $taulaProcessada = $taulaOrdenada->map(function($item, $index) use (&$nouRanquing, &$hiHaCanvis) {
            $posicioActual = $index + 1;
            $nouRanquing[$item['id']] = $posicioActual; // Guardem posició actual

            // Comparem amb l'anterior render
            $posicioAnterior = $this->ranquingAnterior[$item['id']] ?? null;
            
            $item['moviment'] = 'igual'; 

            if ($posicioAnterior !== null) {
                if ($posicioActual < $posicioAnterior) {
                    $item['moviment'] = 'pujar'; // (Ex: 5 -> 3)
                    $hiHaCanvis = true;
                } elseif ($posicioActual > $posicioAnterior) {
                    $item['moviment'] = 'baixar'; // (Ex: 1 -> 2)
                    $hiHaCanvis = true;
                }
            }
            return $item;
        });

        // Alerta JS si hi ha canvis i no és la primera càrrega
        if ($hiHaCanvis && count($this->ranquingAnterior) > 0) {
            $this->dispatch('classificacio-canviada'); 
        }

        // Actualitzem estat per la pròxima
        $this->ranquingAnterior = $nouRanquing;

        return view('livewire.classificacio', ['taula' => $taulaProcessada]);
    }
}