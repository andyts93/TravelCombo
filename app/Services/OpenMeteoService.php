<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class OpenMeteoService extends BaseApiService
{
    protected string $baseUrl = 'https://archive-api.open-meteo.com/v1';

    protected PendingRequest $pendingRequest;

    public function getHistoricalWeather(
        float $lat,
        float $lng,
        Carbon $startDate,
        Carbon $endDate,
    ): ?array
    {
        $params = [
            'precipitation_sum',
            'wind_speed_10m_max',
            'sunshine_duration',
            'temperature_2m_min',
            'temperature_2m_max'
        ];

        $response = $this->pendingRequest->get('/era5', [
            'latitude' => $lat,
            'longitude' => $lng,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'daily' => implode(',', $params),
        ]);

        if ($response->successful()) {
            $json = $response->json();
            if (isset($json['daily'])) {
                $json['avg'] = [];
                foreach ($params as $param) {
                    if (isset($json['daily'][$param])) {
                        try {
                            $json['avg'][$param] = collect($json['daily'][$param])->avg();
                        } catch (\Exception $exception) {}
                    }
                }
            }
            return $json;
        }

        return null;
    }
}
