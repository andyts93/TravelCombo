<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

class OverpassService
{
    protected string $baseUrl = 'https://maps.mail.ru/osm/tools/overpass/api';

    protected PendingRequest $pendingRequest;

    public function __construct()
    {
        $userAgent = env('NOMINATIM_USER_AGENT', config('app.name'));

        $this->pendingRequest = Http::withHeader('User-Agent', $userAgent)
            ->baseUrl($this->baseUrl);
    }

    public function searchNearbyPOIs(
        float $lat,
        float $lng,
        int $radiusInMeters = 5000,
        string $tagKey = 'tourism',
        string $tagValue = 'museum'
    ): ?array
    {
        $query = "
            [out:json][timeout:25];
            (
                nwr[\"$tagKey\"=\"$tagValue\"](around:$radiusInMeters,$lat,$lng);
                nwr[\"shop\"=\"supermarket\"](around:$radiusInMeters,$lat,$lng);
                nwr[\"shop\"=\"gift\"](around:$radiusInMeters,$lat,$lng);
                nwr[\"public_transport\"=\"station\"](around:$radiusInMeters,$lat,$lng);
            );
            out center;
        ";

        while (RateLimiter::tooManyAttempts('overpass-request', 1)) {
            usleep(100_000);
        }
        RateLimiter::hit('overpass-request', 1);

        $response = $this->pendingRequest->get('/interpreter', [
            'data' => $query,
        ]);

        if ($response->successful()) {
            return $response->json()['elements'];
        }

        return null;
    }
}
