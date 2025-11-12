<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleTraslado
 *
 * @property $id
 * @property $Cantidad_Adultos
 * @property $Cantidad_Menores
 * @property $detalle_reserva_id
 * @property $Empresa_traslados_tipo_movilidades_id
 * @property $fecha_servicio
 * @property $hora_servicio
 * @property $Precio_Adulto
 * @property $Precio_Menor
 * @property $Precio_Total
 * @property $updated_at
 * @property $created_at
 *
 * @property DetalleReserva $detalleReserva
 * @property EmpresaTrasladoTipoMovilidade $empresaTrasladoTipoMovilidade
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetalleTraslado extends Model
{
    
    static $rules = [
		'Cantidad_Adultos' => 'required',
		'Cantidad_Menores' => 'required',
		'detalle_reserva_id' => 'required',
		'Empresa_traslados_tipo_movilidades_id' => 'required',
		'fecha_servicio' => 'required',
		'hora_servicio' => 'required',
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
    protected $fillable = ['Cantidad_Adultos','Cantidad_Menores','detalle_reserva_id','Empresa_traslados_tipo_movilidades_id','servicio_traslados_id','Lugar_Origen','Lugar_Destino','fecha_servicio','hora_servicio','Precio_Adulto','Precio_Menor','Precio_Total'];


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
    public function empresaTrasladoTipoMovilidade()
    {
        return $this->hasOne('App\Models\EmpresaTrasladoTipoMovilidade', 'id', 'Empresa_traslados_tipo_movilidades_id');
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function servicioTraslado()
    {
        return $this->hasOne('App\Models\ServicioTraslado', 'id', 'servicio_traslados_id');
    }
    

}
