<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarritoHotel
 *
 * @property $id
 * @property $Fecha_In
 * @property $Fecha_Out
 * @property $Id_tipo_habitacion_hotels
 * @property $Id_regimen
 * @property $Cantidad_Adultos
 * @property $Cantidad_Menores
 * @property $Cantidad_Noches
 * @property $Precio_promedio_por_noche
 * @property $Precio_total_habitacion
 * @property $Cantidad_habitaciones
 * @property $Precio_Total
 * @property $Nombre_Habitacion
 * @property $Nombre_Regimen
 * @property $carrito_compras_items_id
 * @property $updated_at
 * @property $created_at
 *
 * @property CarritoComprasItem $carritoComprasItem
 * @property Regimen $regimen
 * @property TipoHabitacionGeneral $tipoHabitacionGeneral
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CarritoHotel extends Model
{
    
    static $rules = [
		'Fecha_In' => 'required',
		'Fecha_Out' => 'required',
		'Id_tipo_habitacion_hotels' => 'required',
		'Id_regimen' => 'required',
		'Cantidad_Adultos' => 'required',
		'Cantidad_Menores' => 'required',
		'Cantidad_Noches' => 'required',
		'Precio_promedio_por_noche' => 'required',
		'Precio_total_habitacion' => 'required',
		'Cantidad_habitaciones' => 'required',
		'Precio_Total' => 'required',
		'Nombre_Habitacion' => 'required',
		'Nombre_Regimen' => 'required',
		'carrito_compras_items_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Fecha_In','Fecha_Out','Id_tipo_habitacion_hotels','Id_regimen','politica_id','Cantidad_Adultos','Cantidad_Menores','Cantidad_Noches','Precio_promedio_por_noche','Precio_total_habitacion','Cantidad_habitaciones','Precio_Total','Nombre_Habitacion','Nombre_Regimen','carrito_compras_items_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function carritoComprasItem()
    {
        return $this->hasOne('App\Models\CarritoComprasItem', 'id', 'carrito_compras_items_id');
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
    public function politica()
    {
        return $this->hasOne('App\Models\PoliticaCancelacion', 'id', 'politica_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoHabitacionGeneral()
    {
        return $this->hasOne('App\Models\TipoHabitacionGeneral', 'id', 'Id_tipo_habitacion_hotels');
    }
    

}
