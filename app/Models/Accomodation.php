<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'timezone'
    ];

    protected $casts = [
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];

    protected function dateFrom(): Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->timezone($this->timezone ?? 'UTC'));
    }

    protected function dateTo(): Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->timezone($this->timezone ?? 'UTC'));
    }
}
