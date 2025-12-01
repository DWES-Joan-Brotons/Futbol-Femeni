<?php
namespace App\Services;

use App\Repositories\EquipRepository;
use Illuminate\Support\Facades\Storage; // <--- NO T'OBLIDIS D'IMPORTAR AIXÒ

class EquipService {
    public function __construct(private EquipRepository $repo) {}

    public function llistar() {
        return $this->repo->getAll();
    }

    public function trobar($id){
        return $this->repo->find($id);
    }

    public function guardar(array $data) {
        // Si ve un fitxer 'escut', el guardem al disc 'public' dins la carpeta 'escuts'
        if (isset($data['escut'])) {
            $data['escut'] = $data['escut']->store('escuts', 'public');
        }
        return $this->repo->create($data);
    }

    public function actualitzar($id, array $data) {
        $equip = $this->repo->find($id);

        if (isset($data['escut'])) {
            // Si ja tenia un escut antic, l'esborrem per no acumular brossa
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }
            // Guardem el nou
            $data['escut'] = $data['escut']->store('escuts', 'public');
        }

        return $this->repo->update($id, $data);
    }

    public function eliminar($id) {
        $equip = $this->repo->find($id);
        // Si eliminem l'equip, eliminem també la imatge
        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }
        return $this->repo->delete($id);
    }
}