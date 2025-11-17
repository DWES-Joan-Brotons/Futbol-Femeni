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
    protected $fillable = ['nom', 'estadi_id', 'titols' ];

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

    /**
     * Defineix una relació que retorna un Query Builder 
     * per a tots els partits (local o visitant).
     */
    public function partits()
    {
        return Partit::where('local_id', $this->id)
                     ->orWhere('visitant_id', $this->id);
    }

    /**
     * Accessor per a $equip->partits
     * Ara utilitza el mètode partits() per ser més eficient.
     */
    public function getPartitsAttribute()
    {
        return $this->partits()->get();
    }

    /**
     * Accessor per a $equip->ultimsPartits
     * Ara crida el mètode partits() que acabem de definir.
     */
    public function getUltimsPartitsAttribute()
    {
        return $this->partits() // Aquesta crida ara és vàlida
            ->where('data', '<=', Carbon::now())
            ->orderBy('data', 'desc')
            ->limit(5)
            ->get();
    }

    public function getEdatMitjanaAttribute(): ?float
    {
        // Comprova que hi hagi jugadores per evitar divisió per zero si la col·lecció és buida
        if ($this->jugadores()->count() == 0) {
            return null;
        }
        
        return $this->jugadores()->avg(DB::raw('TIMESTAMPDIFF(YEAR, data_naixement, CURDATE())'));
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function manager()
    {
        return $this->hasOne(User::class   );
    }
}