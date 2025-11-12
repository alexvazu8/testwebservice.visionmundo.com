<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reserva
 *
 * @property $id
 * @property $tipo_reserva
 * @property $Localizador
 * @property $Importe_Reserva
 * @property $Nombre_Cliente
 * @property $Numero_Adultos
 * @property $Numero_menores
 * @property $created_at
 * @property $updated_at
 *
 * @property DetalleReserva[] $detalleReservas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reserva extends Model
{
    
    static $rules = [
		
		'Localizador' => 'required',
		'Importe_Reserva' => 'required',
		'Nombre_Cliente' => 'required',
		'Apellido_Cliente' => 'required',
		'Telefono_Cliente' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Localizador','Importe_Reserva','Nombre_Cliente','Apellido_Cliente','Telefono_Cliente','Email_contacto_reserva','Comentarios','Usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleReservas()
    {
        return $this->hasMany('App\Models\DetalleReserva', 'Reserva_Id_reserva', 'id');
    }
    

}
