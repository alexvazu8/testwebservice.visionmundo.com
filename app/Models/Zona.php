<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Zona
 *
 * @property $Id_Zona
 * @property $Nombre_Zona
 * @property $Ciudad_Id_Ciudad
 *
 * @property Ciudade $ciudade
 * @property Hotel[] $hotels
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Zona extends Model
{
    
    static $rules = [
		'Id_Zona' => 'required',
		'Nombre_Zona' => 'required',
		'Ciudad_Id_Ciudad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Id_Zona','Nombre_Zona','Ciudad_Id_Ciudad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ciudade()
    {
        return $this->hasOne('App\Models\Ciudade', 'Id_Ciudad', 'Ciudad_Id_Ciudad');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotels()
    {
        return $this->hasMany('App\Models\Hotel', 'Zona_Id_Zona', 'Id_Zona');
    }
    

}
