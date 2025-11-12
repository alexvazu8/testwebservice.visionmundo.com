<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hotel
 *
 * @property $Id_Hotel
 * @property $Nombre_Hotel
 * @property $Numero_identificacion_tributaria
 * @property $Direccion_Hotel
 * @property $Telefono_reservas_hotel
 * @property $Cel_reservas_hotel
 * @property $email_reservas_hotel
 * @property $email_comercial_hotel
 * @property $Pais_Id_Pais
 * @property $Zona_Id_Zona
 * @property $ciudad_Id_ciudad
 * @property $Descripcion_Hotel
 * @property $Latitud
 * @property $Longitud
 * @property $Foto_Principal_Hotel
 * @property $updated_at
 * @property $created_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Hotel extends Model
{
    
    static $rules = [
		'Id_Hotel' => 'required',
		'Pais_Id_Pais' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Id_Hotel','Nombre_Hotel','Numero_identificacion_tributaria','Direccion_Hotel','Telefono_reservas_hotel','Cel_reservas_hotel','email_reservas_hotel','email_comercial_hotel','Pais_Id_Pais','Zona_Id_Zona','ciudad_Id_ciudad','Descripcion_Hotel','Latitud','Longitud','Foto_Principal_Hotel'];

    public function estrellas()
    {
        return $this->hasOne('App\Models\Estrella', 'id', 'estrellas_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function fotosHotels()
    {
        return $this->hasMany('App\Models\FotosHotel', 'Hotel_Id_Hotel', 'Id_Hotel');
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotelFacilidadesYServicios()
    {
        return $this->hasMany('App\Models\HotelFacilidadesYServicio', 'Hotel_Id_Hotel', 'Id_Hotel');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotelUsers()
    {
        return $this->hasMany('App\Models\HotelUser', 'hotel_Id_hotel', 'Id_Hotel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tipoHabitacionHotels()
    {
        return $this->hasMany('App\Models\TipoHabitacionHotel', 'Hotel_Id_Hotel', 'Id_Hotel');
    }
    
    public function pais()
    {
        return $this->hasOne('App\Models\Paise', 'Id_Pais','Pais_Id_Pais');
    }
    public function ciudad()
    {
        return $this->hasOne('App\Models\Ciudade', 'Id_Ciudad','ciudad_Id_ciudad');
    }

    function zona()
    {
        return $this->hasOne('App\Models\Zona', 'Id_Zona','Zona_Id_Zona');
    }


}

