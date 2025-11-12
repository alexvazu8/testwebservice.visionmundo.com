<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PreciosCupoRelease
 *
 * @property $id
 * @property $Costo_habitacion
 * @property $Release_habitacion
 * @property $Cupo_habitacion
 * @property $Tipo_habitacion_hotel_id_tipo_habitacion_hotel
 * @property $Fecha_precio_cupo_release_noche
 * @property $Cierre
 * @property $updated_at
 * @property $created_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PreciosCupoRelease extends Model
{
    
    static $rules = [
		'Costo_habitacion' => 'required',
		'Release_habitacion' => 'required',
		'Cupo_habitacion' => 'required',
		'Tipo_habitacion_hotel_id_tipo_habitacion_hotel' => 'required',
		'Fecha_precio_cupo_release_noche' => 'required',
		'Cierre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Costo_habitacion','Release_habitacion','Cupo_habitacion','Tipo_habitacion_hotel_id_tipo_habitacion_hotel','Fecha_precio_cupo_release_noche','Cierre','politica_id','regimen_id'];

    public function tipoHabitacionHotel()
    {
        return $this->hasOne('App\Models\TipoHabitacionHotel', 'id', 'Tipo_habitacion_hotel_id_tipo_habitacion_hotel');
    }
    public function regimen()
    {
        return $this->hasOne('App\Models\Regimen', 'id', 'regimen_id');
    }

    public function politacaCancelacions()
    {
        return $this->hasOne('App\Models\PoliticaCancelacion', 'id', 'politica_id');
    }

}
