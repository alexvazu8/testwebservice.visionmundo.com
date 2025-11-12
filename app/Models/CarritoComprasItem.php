<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarritoComprasItem
 *
 * @property $id
 * @property $Usuario_id
 * @property $Numero_adultos
 * @property $Numero_menores
 * @property $Tipo_servicio
 * @property $id_servicio
 * @property $Fecha_In
 * @property $Fecha_Out
 * @property $hora_servicio
 * @property $Precio_adulto
 * @property $Precio_menor
 * @property $Precio_Total
 * @property $Costo_Total
 * @property $Email_encargado_reserva
 * @property $updated_at
 * @property $created_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CarritoComprasItem extends Model
{
    
    static $rules = [
		'Usuario_id' => 'required',
		'Tipo_servicio' => 'required',
    'Costo_Total' => 'required',
		'Precio_Total' => 'required',
    
    ];
 

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Usuario_id','Tipo_servicio','Costo_Total','Precio_Total','token','expiration_token','Email_encargado_reserva'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carritoHotels()
    { 
        return $this->hasOne(CarritoHotel::class, 'carrito_compras_items_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carritoTours()
    {
        return $this->hasOne('App\Models\CarritoTour', 'carrito_compras_items_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carritoTraslados()
    {
        return $this->hasOne('App\Models\CarritoTraslado', 'carrito_compras_items_id', 'id');
    }
   /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'Usuario_id');
    }


}