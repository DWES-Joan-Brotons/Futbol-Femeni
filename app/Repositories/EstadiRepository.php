<?php

namespace App\Repositories;

use App\Models\Estadi;

class EstadiRepository implements BaseRepository {
    public function getAll() {
        return Estadi::all();
    }

    public function find($id) {
        return Estadi::findOrFail($id);
    }

    public function create(array $data) {
        return Estadi::create($data);
    }

    public function update($id, array $data) {
        $estadi = Estadi::findOrFail($id);
        $estadi->update($data);
        return $estadi;
    }

    public function delete($id) {
        return Estadi::destroy($id);
    }
}