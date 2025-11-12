<?php

namespace App\Models;
use App\Models\ServicioTraslado; 

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrasladosContratoCupo
 *
 * @property $id
 * @property $Cantidad_adultos
 * @property $Cantidad_menores
 * @property $Costo_adulto
 * @property $Costo_menor
 * @property $Edad_menor
 * @property $Fecha_disponible
 * @property $Cupo
 * @property $Release
 * @property $cierre
 * @property $hora_inicio_atencion
 * @property $hora_final_atencion
 * @property $Empresa_traslado_tipo_movilidades_id
 * @property $Servicio_traslado_Id
 * @property $updated_at
 * @property $created_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TrasladosContratoCupo extends Model
{
    
    static $rules = [
		'Cantidad_adultos' => 'required',
		'Cantidad_menores' => 'required',
		'Costo_adulto' => 'required',
		'Costo_menor' => 'required',
		'Edad_menor' => 'required',
		'Fecha_disponible' => 'required',
		//'Cupo' => 'required',
		//'Release' => 'required',
		//'cierre' => 'required',
		'hora_inicio_atencion'=> 'required',
		'hora_final_atencion' => 'required',
		//'Empresa_traslado_tipo_movilidades_id' => 'required',
		//'Servicio_traslado_Id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Cantidad_adultos','Cantidad_menores','Costo_adulto','Costo_menor','Edad_menor','Fecha_disponible','Cupo','Release','cierre','hora_inicio_atencion','hora_final_atencion','Empresa_traslado_tipo_movilidades_id','Servicio_traslado_Id'];

    //Relacion con la tabla servicio_traslados
    public function servicioTraslado()
    {
        return $this->belongsTo(ServicioTraslado::class, 'Servicio_traslado_Id');
    }

}
