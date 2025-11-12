<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarritoTour
 *
 * @property $id
 * @property $Fecha_In
 * @property $Fecha_Out
 * @property $Cantidad_Adultos
 * @property $Cantidad_Menores
 * @property $Precio_Adulto
 * @property $Precio_Menor
 * @property $Precio_Total
 * @property $id_tours
 * @property $carrito_compras_items_id
 * @property $updated_at
 * @property $created_at
 *
 * @property CarritoComprasItem $carritoComprasItem
 * @property Tour $tour
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CarritoTour extends Model
{
    
    static $rules = [
		'Fecha_Out' => 'required',
		'Cantidad_Adultos' => 'required',
		'Cantidad_Menores' => 'required',
		'Precio_Adulto' => 'required',
		'Precio_Menor' => 'required',
		'Precio_Total' => 'required',
		'id_tours' => 'required',
		'carrito_compras_items_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Fecha_In','Fecha_Out','Cantidad_Adultos','Cantidad_Menores','Precio_Adulto','Precio_Menor','Precio_Total','id_tours','carrito_compras_items_id'];


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
    public function tour()
    {
        return $this->hasOne('App\Models\Tour', 'id', 'id_tours');
    }
    

}
