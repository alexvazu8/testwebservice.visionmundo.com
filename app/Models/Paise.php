<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paise
 *
 * @property $Id_Pais
 * @property $Nombre_Pais
 *
 * @property Ciudade[] $ciudades
 * @property Hotel[] $hotels
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Paise extends Model
{
    
    static $rules = [
		'Id_Pais' => 'required',
		'Nombre_Pais' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Id_Pais','Nombre_Pais'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ciudades()
    {
        return $this->hasMany('App\Models\Ciudade', 'Pais_Id_Pais', 'Id_Pais');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotels()
    {
        return $this->hasMany('App\Models\Hotel', 'Pais_Id_Pais', 'Id_Pais');
    }
    

}
