<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PoliticaCancelacion
 *
 * @property $id
 * @property $Nombre_Politica
 * @property $updated_at
 * @property $created_at
 *
 * @property Penalidad[] $penalidads
 * @property PreciosCupoRelease[] $preciosCupoReleases
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PoliticaCancelacion extends Model
{
    
    static $rules = [
		'Nombre_Politica' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre_Politica'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penalidads()
    {
        return $this->hasMany('App\Models\Penalidad', 'politica_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function preciosCupoReleases()
    {
        return $this->hasMany('App\Models\PreciosCupoRelease', 'politica_id', 'id');
    }
    

}
