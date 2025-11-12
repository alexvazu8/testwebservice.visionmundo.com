<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleTour
 *
 * @property $id
 * @property $Cantidad_Adultos
 * @property $Cantidad_Menores
 * @property $detalle_reserva_id
 * @property $Fecha_In
 * @property $Fecha_Out
 * @property $Id_tours
 * @property $Precio_Adulto
 * @property $Precio_Menor
 * @property $Precio_Total
 * @property $updated_at
 * @property $created_at
 *
 * @property DetalleReserva $detalleReserva
 * @property Tour $tour
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetalleTour extends Model
{
    
    static $rules = [
		'Cantidad_Adultos' => 'required',
		'Cantidad_Menores' => 'required',
		'detalle_reserva_id' => 'required',
		'Fecha_In' => 'required',
		'Fecha_Out' => 'required',
		'Id_tours' => 'required',
		'Precio_Adulto' => 'required',
		'Precio_Menor' => 'required',
		'Precio_Total' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Cantidad_Adultos','Cantidad_Menores','detalle_reserva_id','Fecha_In','Fecha_Out','Id_tours','Precio_Adulto','Precio_Menor','Precio_Total'];


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
    public function tour()
    {
        return $this->hasOne('App\Models\Tour', 'id', 'Id_tours');
    }
    

}
