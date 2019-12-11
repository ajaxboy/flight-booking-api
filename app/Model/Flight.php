<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'flight_number',
        'airline',
        'origin',
        'destination',
        'boarding_time',
        'arrival_time',
        'arrival_time',
        'arrival_time',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
