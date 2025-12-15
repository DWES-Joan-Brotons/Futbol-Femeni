<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_id', 
        'visitant_id', 
        'estadi_id', 
        'arbitre_id', // <--- Nuevo campo
        'data', 
        'jornada', 
        'gols_local', 
        'gols_visitant'
    ];

    protected $casts = [
        'data' => 'datetime',
    ];

    public function equipLocal() { return $this->belongsTo(Equip::class, 'local_id'); }
    public function equipVisitant() { return $this->belongsTo(Equip::class, 'visitant_id'); }
    public function estadi() { return $this->belongsTo(Estadi::class); }
    public function arbitre() { return $this->belongsTo(User::class, 'arbitre_id'); }

    public function getResultatAttribute(): string
    {
        if ($this->gols_local !== null) {
            return $this->gols_local . ' - ' . $this->gols_visitant;
        }
        return 'Pendent';
    }
}