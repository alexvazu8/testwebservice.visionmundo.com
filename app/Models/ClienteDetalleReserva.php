<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClienteDetalleReserva
 *
 * @property $id
 * @property $Detalle_reserva_Id_detalle_Reserva
 * @property $Cliente_Id_Cliente
 *
 * @property Cliente $cliente
 * @property DetalleReserva $detalleReserva
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ClienteDetalleReserva extends Model
{
    
    static $rules = [
		'Detalle_reserva_Id_detalle_Reserva' => 'required',
		'Cliente_Id_Cliente' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Detalle_reserva_Id_detalle_Reserva','Cliente_Id_Cliente'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'Cliente_Id_Cliente');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detalleReserva()
    {
        return $this->hasOne('App\Models\DetalleReserva', 'id', 'Detalle_reserva_Id_detalle_Reserva');
    }
    

}
