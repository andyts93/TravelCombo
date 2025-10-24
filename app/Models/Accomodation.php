<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    protected $fillable = [
        'name',
        'trip_id',
        'addressLine',
        'city',
        'administrative_area',
        'postal_code',
        'region_code',
        'latitude',
        'longitude',
        'date_from',
        'date_to',
        'price',
        'people',
        'url',
    ];
}
