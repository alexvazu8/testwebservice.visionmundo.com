<?php

namespace App\Models;
use App\Models\Tour;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ToursContratoCupo
 *
 * @property $id
 * @property $Costo

 * @property $Fecha_disponible

 * @property $Cupo
 * @property $Release
 * @property $cierre
 * @property $Tours_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Tour $tour
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ToursContratoCupo extends Model
{
    
    static $rules = [
		'Costo_adulto' => 'required',
		'Fecha_disponible' => 'required',
		'Cupo' => 'required',
		'Release' => 'required',
		'cierre' => 'required',
		'Tours_id' => 'required',
    ];
    static $rulesrango = [
      'Cantidad_adultos' => 'required',
      'Cantidad_menores' => 'required',
      'Costo_adulto' => 'required',
      'Fecha_de' => 'required',
      'Fecha_hasta' => 'required',
      'Cupo' => 'required',
      'Release' => 'required',
      'Costo_menor' => 'required',
      'Edad_menor' => 'required',
      'cierre' => 'required',
      'Tours_id' => 'required',
      ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Cantidad_adultos','Cantidad_menores','Costo_adulto','Costo_menor','Edad_menor','Fecha_disponible','Cupo','Release','cierre','Tours_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tour()
    {     
      return $this->belongsTo(Tour::class,'Tours_id');
       // return $this->hasOne('App\Models\Tour', 'id', 'Tours_id');
    }
    public function mostrar_tour($idtour,$fecha_calendario)
    {
          
        
       $res=$this->where('Tours_id', $idtour)
      ->where('Fecha_disponible', $fecha_calendario)
      ->get(); 
      //print_r($res);
   
   return $res;


      
    }

    

}
