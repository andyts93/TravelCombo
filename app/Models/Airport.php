<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $fillable = [
        'ident',
        'iata_code',
        'name',
        'country_id',
        'municipality',
        'gps_code',
        'local_code',
        'latitude',
        'longitude',
        'timezone',
    ];
}
