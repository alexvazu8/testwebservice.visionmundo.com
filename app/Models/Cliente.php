<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $Documento_Id_Cliente
 * @property $Nombre_Cliente
 * @property $Apellido_Cliente
 * @property $Telefono_emergencias_Cliente
 * @property $Mail_emergencias_cliente
 * @property $updated_at
 * @property $created_at
 *
 * @property ClienteDetalleReserva[] $clienteDetalleReservas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    
    static $rules = [
		'Documento_Id_Cliente' => 'required',
		'Nombre_Cliente' => 'required',
		'Apellido_Cliente' => 'required',
		'Telefono_emergencias_Cliente' => 'required',
		'Mail_emergencias_cliente' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Documento_Id_Cliente','COD_IATA_PAIS','Tipo','Nombre_Cliente','Apellido_Cliente','Telefono_emergencias_Cliente','Mail_emergencias_cliente'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clienteDetalleReservas()
    {
        return $this->hasMany('App\Models\ClienteDetalleReserva', 'Cliente_Id_Cliente', 'id');
    }
    

}
