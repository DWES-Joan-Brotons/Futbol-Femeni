<?php
namespace App\Services;

use App\Repositories\EquipRepository;

class EquipService {
    public function __construct(private EquipRepository $repo) {}

    public function llistar() {
        return $this->repo->getAll();
    }

    public function trobar($id){
        return $this->repo->find($id);
    }

    public function guardar(array $data) {
        return $this->repo->create($data);
    }

    public function actualitzar($id, array $data) {
        return $this->repo->update($id, $data);
    }

    public function eliminar($id) {
        return $this->repo->delete($id);
    }
}
