<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Model EQUIP
 */
class Equip extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['nom', 'estadi_id', 'titols', 'escut']; // <--- AFEGIT 'escut'

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    public function jugadores()
    {
        return $this->hasMany(Jugadora::class);
    }

    public function partitsLocal()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    public function partitsVisitant()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }

    public function partits()
    {
        return Partit::where('local_id', $this->id)
                     ->orWhere('visitant_id', $this->id);
    }

    public function getPartitsAttribute()
    {
        return $this->partits()->get();
    }

    public function getUltimsPartitsAttribute()
    {
        return $this->partits()
            ->where('data', '<=', Carbon::now())
            ->orderBy('data', 'desc')
            ->limit(5)
            ->get();
    }

    public function getEdatMitjanaAttribute(): ?float
    {
        if ($this->jugadores()->count() == 0) {
            return null;
        }
        
        return $this->jugadores()->avg(DB::raw('TIMESTAMPDIFF(YEAR, data_naixement, CURDATE())'));
    }
    
    public function manager()
    {
        return $this->hasOne(User::class);
    }
}