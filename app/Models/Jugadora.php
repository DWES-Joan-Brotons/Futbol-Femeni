<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Jugadora extends Model
{
    use HasFactory;

    protected $fillable = ['equip_id', 'nom', 'data_naixement', 'dorsal', 'foto'];

    protected $casts = [
        'data_naixement' => 'date',
    ];

    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }

    public function getEdatAttribute(): int
    {
        return Carbon::parse($this->data_naixement)->age;
    }
}