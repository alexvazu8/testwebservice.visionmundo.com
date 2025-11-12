<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Regimen
 *
 * @property $id
 * @property $nombre_regimen
 * @property $codigo_regimen
 * @property $updated_at
 * @property $created_at
 *
 * @property RegimenTipoHabitacionHotel[] $regimenTipoHabitacionHotels
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Regimen extends Model
{
    
    static $rules = [
		'nombre_regimen' => 'required',
		'codigo_regimen' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_regimen','codigo_regimen'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regimenTipoHabitacionHotels()
    {
        return $this->hasMany('App\Models\RegimenTipoHabitacionHotel', 'id_regimen', 'id');
    }
    

}
