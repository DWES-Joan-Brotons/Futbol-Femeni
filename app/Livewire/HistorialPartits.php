<?php

namespace App\Livewire;

use App\Models\Partit;
use Livewire\Component;

class HistorialPartits extends Component
{
    public $partits;
    public $equip = '';
    public $data = '';

    public function mount()
    {
        // Carreguem els partits inicials
        $this->filtrar();
    }

    public function filtrar()
    {
        $this->partits = Partit::with(['equipLocal', 'equipVisitant', 'estadi', 'arbitre'])
            ->when($this->equip, function ($query) {
                // Busquem l'equip tant si juga com a local o com a visitant
                $query->whereHas('equipLocal', fn($q) => $q->where('nom', 'like', "%{$this->equip}%"))
                      ->orWhereHas('equipVisitant', fn($q) => $q->where('nom', 'like', "%{$this->equip}%"));
            })
            ->when($this->data, function ($query) {
                $query->whereDate('data', $this->data);
            })
            ->orderBy('data', 'desc') // Ordenem per data, els més recents primer
            ->get();
    }

    public function render()
    {
        return view('livewire.historial-partits');
    }
}