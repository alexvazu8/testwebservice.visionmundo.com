<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelFacilidadesYServicio
 *
 * @property $id
 * @property $Hotel_Id_Hotel
 * @property $facilidades_y_servicios_generales_Id_facilidad_y_servicio_genera
 * @property $costo
 * @property $moneda
 * @property $texto_facilidad
 * @property $updated_at
 * @property $created_at
 *
 * @property FacilidadesYServiciosGeneral $facilidadesYServiciosGeneral
 * @property Hotel $hotel
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HotelFacilidadesYServicio extends Model
{
    
    static $rules = [
		'Hotel_Id_Hotel' => 'required',
		'facilidades_y_servicios_generales_Id_facilidad_y_servicio_genera' => 'required',
		'moneda' => 'required',
		'texto_facilidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Hotel_Id_Hotel','facilidades_y_servicios_generales_Id_facilidad_y_servicio_genera','costo','moneda','texto_facilidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function facilidadesYServiciosGeneral()
    {
        return $this->hasOne('App\Models\FacilidadesYServiciosGeneral', 'id', 'facilidades_y_servicios_generales_Id_facilidad_y_servicio_genera');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hotel()
    {
        return $this->hasOne('App\Models\Hotel', 'Id_Hotel', 'Hotel_Id_Hotel');
    }
    

}
