<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleHotel
 *
 * @property $id
 * @property $Cantidad_Adultos
 * @property $Cantidad_Menores
 * @property $Cantidad_Noches
 * @property $Fecha_In
 * @property $Fecha_Out
 * @property $Id_regimen
 * @property $Id_tipo_habitacion_hotels
 * @property $Nombre_Habitacion
 * @property $Nombre_Regimen
 * @property $Precio_promedio_por_noche
 * @property $Precio_Total
 * @property $Precio_total_habitacion
 * @property $Cantidad_habitaciones
 * @property $detalle_reserva_id
 * @property $updated_at
 * @property $created_at
 *
 * @property DetalleReserva $detalleReserva
 * @property Regimen $regimen
 * @property TipoHabitacionHotel $tipoHabitacionHotel
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetalleHotel extends Model
{
    
    static $rules = [
		'Cantidad_Adultos' => 'required',
		'Cantidad_Menores' => 'required',
		'Cantidad_Noches' => 'required',
		'Fecha_In' => 'required',
		'Fecha_Out' => 'required',
		'Id_regimen' => 'required',
		'Id_tipo_habitacion_hotels' => 'required',
		'Nombre_Habitacion' => 'required',
		'Nombre_Regimen' => 'required',
		'Precio_promedio_por_noche' => 'required',
		'Precio_Total' => 'required',
		'Precio_total_habitacion' => 'required',
		'Cantidad_habitaciones' => 'required',
		'detalle_reserva_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Cantidad_Adultos','Cantidad_Menores','Cantidad_Noches','Fecha_In','Fecha_Out','Id_regimen','politica_id','Id_tipo_habitacion_hotels','Nombre_Habitacion','Nombre_Regimen','Precio_promedio_por_noche','Precio_Total','Precio_total_habitacion','Cantidad_habitaciones','detalle_reserva_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detalleReserva()
    {
        return $this->hasOne('App\Models\DetalleReserva', 'id', 'detalle_reserva_id');
    }
    
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function regimen()
    {
        return $this->hasOne('App\Models\Regimen', 'id', 'Id_regimen');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoHabitacionHotel()
    {
        return $this->hasOne('App\Models\TipoHabitacionHotel', 'id', 'Id_tipo_habitacion_hotels');
    }
    
    // En el modelo DetalleHotel.php
    public function politica()
    {
        return $this->belongsTo('App\Models\PoliticaCancelacion', 'politica_id', 'id');
    }

}
