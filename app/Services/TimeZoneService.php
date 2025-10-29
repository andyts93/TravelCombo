<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TimeZoneService
{
    public static function getTimezone($lat, $lng): ?object
    {
        try {
            $response = Http::get('https://api.timezonedb.com/v2.1/get-time-zone', [
                'key' => env('TIMEZONEDB_API_KEY'),
                'format' => 'json',
                'by' => 'position',
                'lat' => $lat,
                'lng' => $lng,
            ]);
            return json_decode($response->body());
        } catch (\Exception $exception) {
            Log::error('Error getting the timezone', [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => ['lat' => $lat, 'lng' => $lng],
            ]);
            return null;
        }
    }
}
