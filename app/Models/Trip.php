<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_timezone',
    ];

    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }

    public function outboundFlights(): HasMany
    {
        return $this->hasMany(Flight::class)->where('trip_type', 'outbound');
    }

    public function accomodations(): HasMany
    {
        return $this->hasMany(Accomodation::class);
    }
}
