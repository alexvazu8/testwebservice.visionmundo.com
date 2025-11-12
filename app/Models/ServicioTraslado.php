<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServicioTraslado
 *
 * @property $id
 * @property $Nombre_Servicio
 * @property $Detalle_servicio
 * @property $Tipo_servicio_tansfer
 * @property $empresa_traslado_tipo_movilidades_Id
 * @property $Zona_Origen_id
 * @property $Zona_Destino_id
 * @property $Email_contacto_traslado
 * @property $updated_at
 * @property $created_at
 *
 * @property EmpresaTrasladoTipoMovilidade $empresaTrasladoTipoMovilidade
 * @property TrasladosContratoCupo[] $trasladosContratoCupos
 * @property Zona $zona
 * @property Zona $zona
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ServicioTraslado extends Model
{
    
    static $rules = [
		'Nombre_Servicio' => 'required',
		'Detalle_servicio' => 'required',
		'Tipo_servicio_transfer' => 'required',
		'empresa_traslado_tipo_movilidades_Id' => 'required',
		'Zona_Origen_id' => 'required',
		'Zona_Destino_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre_Servicio','Detalle_servicio','Tipo_servicio_transfer','empresa_traslado_tipo_movilidades_Id','Zona_Origen_id','Zona_Destino_id','Email_contacto_traslado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresaTrasladoTipoMovilidade()
    {
        return $this->hasOne('App\Models\EmpresaTrasladoTipoMovilidade', 'id', 'empresa_traslado_tipo_movilidades_Id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trasladosContratoCupos()
    {
        return $this->hasMany('App\Models\TrasladosContratoCupo', 'Servicio_traslado_Id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zona()
    {
        return $this->hasOne('App\Models\Zona', 'Id_Zona', 'Zona_Origen_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zona_destino()
    {
        return $this->hasOne('App\Models\Zona', 'Id_Zona', 'Zona_Destino_id');
    }
    

}
