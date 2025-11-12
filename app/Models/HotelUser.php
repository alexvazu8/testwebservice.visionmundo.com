<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelUser
 *
 * @property $Id_hotels_users
 * @property $hotel_Id_hotel
 * @property $users_id
 * @property $activo
 * @property $updated_at
 * @property $created_at
 *
 * @property Hotel $hotel
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HotelUser extends Model
{
    
    static $rules = [
		'Id_hotels_users' => 'required',
		'hotel_Id_hotel' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Id_hotels_users','hotel_Id_hotel','users_id','activo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hotel()
    {
        return $this->hasOne('App\Models\Hotel', 'Id_Hotel', 'hotel_Id_hotel');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'users_id');
    }
    

}
