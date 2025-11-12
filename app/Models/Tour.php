<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tour
 *
 * @property $id
 * @property $Nombre_tour
 * @property $Detalle_tour
 * @property $Recojo_hotel
 * @property $Punto_encuentro
 * @property $cantidad_dias_tour
 * @property $cantidad_noches_tour
 * @property $Horario_inicio
 * @property $Hora_fin
 * @property $Entregan_agua
 * @property $Para_discapacitados
 * @property $Con_bano
 * @property $Pais_Id_Pais
 * @property $Ciudad_Id_Ciudad
 * @property $Zona_Id_Zona
 * @property $updated_at
 * @property $created_at
 *
 * @property Ciudade $ciudade
 * @property DetalleReserva[] $detalleReservas
 * @property Paise $paise
 * @property ToursContratoCupo[] $toursContratoCupos
 * @property Zona $zona
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tour extends Model
{
    
    static $rules = [
		'Nombre_tour' => 'required',
		'Detalle_tour' => 'required',
		'Recojo_hotel' => 'required',
		'Punto_encuentro' => 'required',
		'cantidad_dias_tour' => 'required',
		'cantidad_noches_tour' => 'required',
		'Horario_inicio' => 'required',
		'Hora_fin' => 'required',
		'Entregan_agua' => 'required',
		'Para_discapacitados' => 'required',
		'Con_bano' => 'required',
		'Pais_Id_Pais' => 'required',
		'Ciudad_Id_Ciudad' => 'required',
		'Zona_Id_Zona' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre_tour','Foto_tours','Detalle_tour','Recojo_hotel','Punto_encuentro','cantidad_dias_tour','cantidad_noches_tour','Horario_inicio','Hora_fin','Entregan_agua','Para_discapacitados','Con_bano','Pais_Id_Pais','Ciudad_Id_Ciudad','Zona_Id_Zona'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ciudade()
    {
        return $this->hasOne('App\Models\Ciudade', 'Id_Ciudad', 'Ciudad_Id_Ciudad');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ciudad()
    {
        return $this->hasOne('App\Models\Ciudade', 'Id_Ciudad', 'Ciudad_Id_Ciudad');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleReservas()
    {
        return $this->hasMany('App\Models\DetalleReserva', 'Tour_Id_tour', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paise()
    {
        return $this->hasOne('App\Models\Paise', 'Id_Pais', 'Pais_Id_Pais');
    }
    
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pais()
    {
        return $this->hasOne('App\Models\Paise', 'Id_Pais', 'Pais_Id_Pais');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toursContratoCupos()
    {
        return $this->hasMany('App\Models\ToursContratoCupo', 'Tours_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zona()
    {
        return $this->hasOne('App\Models\Zona', 'Id_Zona', 'Zona_Id_Zona');
    }

    public function getFotoToursAttribute($value)
    {
        return base64_encode($value);
    }
    
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fotosTours()
    {
        return $this->hasMany('App\Models\FotosTour', 'tour_id', 'id');
    }

    

}
