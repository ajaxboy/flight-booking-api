<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'status',
        'passengers',
        'airline',
        'reservation_time',
        'origin',
        'destination',
        'price',
        'tax',
        'promo_code'
     ];

    protected $hidden = [
      //  'user_id'
    ];

    public function getAirportsAttribute()
    {
        return ['DFW','JFK','MSY','ZVE','BNA','YUL','MEX','LAX','LAS','JAX','IAH','BOS','AUS'];
    }

    public function getAirlinesAttribute()
    {
        return  ['American','Southwest','Spirit','Alaska','Jet Blue','Frontier','Delta','United'];
    }

    public function User() {
        return $this->belongsTo('App\User');
    }
}
