<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FotosHotel
 *
 * @property $id
 * @property $Nombre_Foto_Hotel
 * @property $Foto_Hotel
 * @property $Hotel_Id_Hotel
 * @property $grupo_fotos_id
 * @property $updated_at
 * @property $created_at
 *
 * @property GrupoFotosHotel $grupoFotosHotel
 * @property Hotel $hotel
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FotosHotel extends Model
{
    
    static $rules = [
		'Nombre_Foto_Hotel' => 'required',
		'Foto_Hotel' => 'required',
		'Hotel_Id_Hotel' => 'required',
		'grupo_fotos_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre_Foto_Hotel','Foto_Hotel','Hotel_Id_Hotel','grupo_fotos_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function grupoFotosHotel()
    {
        return $this->hasOne('App\Models\GrupoFotosHotel', 'id', 'grupo_fotos_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hotel()
    {
        return $this->hasOne('App\Models\Hotel', 'Id_Hotel', 'Hotel_Id_Hotel');
    }
    

}
