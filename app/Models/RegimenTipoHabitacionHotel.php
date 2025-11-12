<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RegimenTipoHabitacionHotel
 *
 * @property $id
 * @property $costo_regimen
 * @property $id_tipo_habitacion_hotel
 * @property $id_regimen
 * @property $updated_at
 * @property $created_at
 *
 * @property Regimen $regimen
 * @property TipoHabitacionHotel $tipoHabitacionHotel
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RegimenTipoHabitacionHotel extends Model
{
    
    static $rules = [
		'costo_regimen' => 'required',
		'id_tipo_habitacion_hotel' => 'required',
		'id_regimen' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['costo_regimen','id_tipo_habitacion_hotel','id_regimen'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function regimen()
    {
        return $this->hasOne('App\Models\Regimen', 'id', 'id_regimen');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoHabitacionHotel()
    {
        return $this->hasOne('App\Models\TipoHabitacionHotel', 'id', 'id_tipo_habitacion_hotel');
    }
    

}
