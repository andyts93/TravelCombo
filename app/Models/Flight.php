<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    protected $fillable = [
        'trip_id',
        'airport_from_id',
        'airport_to_id',
        'date_from',
        'date_to',
        'price',
        'people',
    ];

    protected $casts = [
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];

    protected function dateFrom(): Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->timezone($this->airportFrom->timezone ?? 'UTC'));
    }

    protected function dateTo(): Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->timezone($this->airportTo->timezone ?? 'UTC'));
    }

    protected function duration(): Attribute
    {
        return Attribute::get(fn() => intdiv($this->duration_min, 60) . ':' . str_pad($this->duration_min % 60, 2, '0', STR_PAD_LEFT));
    }

    public function airportFrom(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'airport_from_id', 'id');
    }

    public function airportTo(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'airport_to_id', 'id');
    }
}
