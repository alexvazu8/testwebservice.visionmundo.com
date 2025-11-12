<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoHabitacionHotel
 *
 * @property $id
 * @property $Hotel_Id_Hotel
 * @property $Tipo_Habitacion_general_Id_tipo_Habitacion_general
 * @property $Nombre_Habitacion
 * @property $Edad_menores_gratis
 * @property $updated_at
 * @property $created_at
 *
 * @property DetalleReserva[] $detalleReservas
 * @property Hotel $hotel
 * @property PreciosCupoRelease[] $preciosCupoReleases
 * @property RegimenTipoHabitacionHotel[] $regimenTipoHabitacionHotels
 * @property TipoHabitacionGeneral $tipoHabitacionGeneral
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoHabitacionHotel extends Model
{
    
    static $rules = [
		'Hotel_Id_Hotel' => 'required',
		'Tipo_Habitacion_general_Id_tipo_Habitacion_general' => 'required',
		'Nombre_Habitacion' => 'required',
		'Edad_menores_gratis' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Hotel_Id_Hotel','Tipo_Habitacion_general_Id_tipo_Habitacion_general','Nombre_Habitacion','Edad_menores_gratis'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleReservas()
    {
        return $this->hasMany('App\Models\DetalleReserva', 'Tipo_Habitacion_Id_tipo_habitacion_hotel', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hotel()
    {
        return $this->hasOne('App\Models\Hotel', 'Id_Hotel', 'Hotel_Id_Hotel');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function preciosCupoReleases()
    {
        return $this->hasMany('App\Models\PreciosCupoRelease', 'Tipo_habitacion_hotel_id_tipo_habitacion_hotel', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regimenTipoHabitacionHotels()
    {
        return $this->hasMany('App\Models\RegimenTipoHabitacionHotel', 'id_tipo_habitacion_hotel', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoHabitacionGeneral()
    {
        return $this->hasOne('App\Models\TipoHabitacionGeneral', 'id', 'Tipo_Habitacion_general_Id_tipo_Habitacion_general');
    }
    

}
