<?php

namespace App\Repositories;

use App\Models\Partit;

class PartitRepository implements BaseRepository {
    public function getAll() {
        return Partit::all();
    }

    public function find($id) {
        return Partit::findOrFail($id);
    }

    public function create(array $data) {
        return Partit::create($data);
    }

    public function update($id, array $data) {
        $partit = Partit::findOrFail($id);
        $partit->update($data);
        return $partit;
    }

    public function delete($id) {
        return Partit::destroy($id);
    }
}