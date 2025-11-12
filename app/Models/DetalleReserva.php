<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleReserva
 *
 * @property $id
 * @property $Fecha_in
 * @property $Fecha_out
 * @property $Tipo_servicio
 * @property $Precio_Servicio
 * @property $Reserva_Id_reserva
 * @property $Usuario_id
 * @property $Tipo_Habitacion_Id_tipo_habitacion_hotel
 * @property $Tour_Id_tour
 * @property $Empresa_traslados_tipo_movilidades_Id
 * @property $Costo_servicio
 *
 * @property ClienteDetalleReserva[] $clienteDetalleReservas
 * @property EmpresaTrasladoTipoMovilidade $empresaTrasladoTipoMovilidade
 * @property Reserva $reserva
 * @property TipoHabitacionHotel $tipoHabitacionHotel
 * @property Tour $tour
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetalleReserva extends Model
{
    
    static $rules = [
		'Precio_Servicio' => 'required',
		'Reserva_Id_reserva' => 'required',
		'Costo_servicio' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Precio_Servicio','Reserva_Id_reserva','Usuario_id','Tipo_servicio','Costo_servicio','Email_encargado_reserva','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clienteDetalleReservas()
    {
        return $this->hasMany('App\Models\ClienteDetalleReserva', 'Detalle_reserva_Id_detalle_Reserva', 'id');
    }
    

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reserva()
    {
        return $this->hasOne('App\Models\Reserva', 'id', 'Reserva_Id_reserva');
    }
    

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'Usuario_id');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detalleHotel()
    {
        return $this->hasOne(DetalleHotel::class, 'detalle_reserva_id','id');
    }

         /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detalleTour()
    {
        return $this->hasOne(DetalleTour::class, 'detalle_reserva_id','id');
    }
         /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detalleTraslado()
    {
        return $this->hasOne(DetalleTraslado::class, 'detalle_reserva_id','id');
    }
    
    

}
