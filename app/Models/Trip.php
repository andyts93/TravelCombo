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
}
