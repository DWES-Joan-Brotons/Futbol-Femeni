<?php
namespace App\Services;

use App\Repositories\JugadoraRepository;
use Illuminate\Support\Facades\Storage;

class JugadoraService {
    public function __construct(private JugadoraRepository $repo) {}

    public function llistar() {
        return $this->repo->getAll();
    }

    public function trobar($id){
        return $this->repo->find($id);
    }

    public function guardar(array $data) {
        if (isset($data['foto'])) {
            $data['foto'] = $this->pujarFoto($data['foto']);
        }
        return $this->repo->create($data);
    }

    public function actualitzar($id, array $data) {
        if (isset($data['foto'])) {
            $jugadora = $this->repo->find($id);
            if ($jugadora->foto) {
                Storage::disk('public')->delete($jugadora->foto);
            }
            $data['foto'] = $this->pujarFoto($data['foto']);
        }
        return $this->repo->update($id, $data);
    }

    public function eliminar($id) {
        $jugadora = $this->repo->find($id);
        if ($jugadora->foto) {
            Storage::disk('public')->delete($jugadora->foto);
        }
        return $this->repo->delete($id);
    }

    private function pujarFoto($foto): string
    {
        return $foto->store('jugadores', 'public');
    }
}