<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Penalidad
 *
 * @property $id
 * @property $porcentaje_penalidad_por_noche
 * @property $desde_noches_antes
 * @property $hasta_noches_antes
 * @property $politica_id
 * @property $updated_at
 * @property $created_at
 *
 * @property PoliticaCancelacion $politicaCancelacion
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Penalidad extends Model
{
    
    static $rules = [
		'porcentaje_penalidad_por_noche' => 'required',
		'desde_noches_antes' => 'required',
		'hasta_noches_antes' => 'required',
		'politica_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['porcentaje_penalidad_por_noche','desde_noches_antes','hasta_noches_antes','politica_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function politicaCancelacion()
    {
        return $this->hasOne('App\Models\PoliticaCancelacion', 'id', 'politica_id');
    }
    

}
