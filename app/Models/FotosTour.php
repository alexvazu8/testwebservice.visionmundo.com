<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FotosTour
 *
 * @property $id
 * @property $nombre_foto_tour
 * @property $url_foto_tour
 * @property $tour_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Tour $tour
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FotosTour extends Model
{
    
    static $rules = [
		'nombre_foto_tour' => 'required',
		'url_foto_tour' => 'required',
		'tour_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_foto_tour','url_foto_tour','tour_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tour()
    {
        return $this->hasOne('App\Models\Tour', 'id', 'tour_id');
    }
    

}
