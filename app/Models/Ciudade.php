<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ciudade
 *
 * @property $Id_Ciudad
 * @property $Nombre_Ciudad
 * @property $Pais_Id_Pais
 *
 * @property Hotel[] $hotels
 * @property Paise $paise
 * @property Tour[] $tours
 * @property Zona[] $zonas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ciudade extends Model
{
    
    static $rules = [
		'Id_Ciudad' => 'required',
		'Nombre_Ciudad' => 'required',
		'Pais_Id_Pais' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Id_Ciudad','Nombre_Ciudad','Pais_Id_Pais'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotels()
    {
        return $this->hasMany('App\Models\Hotel', 'ciudad_Id_ciudad', 'Id_Ciudad');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paise()
    {
        return $this->hasOne('App\Models\Paise', 'Id_Pais', 'Pais_Id_Pais');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tours()
    {
        return $this->hasMany('App\Models\Tour', 'Ciudad_Id_Ciudad', 'Id_Ciudad');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zonas()
    {
        return $this->hasMany('App\Models\Zona', 'Ciudad_Id_Ciudad', 'Id_Ciudad');
    }
    

}
