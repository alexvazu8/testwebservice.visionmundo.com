<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoMovilidade
 *
 * @property $id
 * @property $Nombre_tipo_movilidad
 * @property $Foto_tipo_movilidad
 * @property $updated_at
 * @property $created_at
 *
 * @property EmpresaTrasladoTipoMovilidade[] $empresaTrasladoTipoMovilidades
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoMovilidade extends Model
{
    
    static $rules = [
		'Nombre_tipo_movilidad' => 'required',
		'Foto_tipo_movilidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre_tipo_movilidad','Foto_tipo_movilidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresaTrasladoTipoMovilidades()
    {
        return $this->hasMany('App\Models\EmpresaTrasladoTipoMovilidade', 'Tipo_movilidad_Id_tipo_movilidad', 'id');
    }
    

}
