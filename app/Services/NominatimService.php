<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

class NominatimService
{
    protected string $baseUrl = 'https://nominatim.openstreetmap.org';

    protected PendingRequest $pendingRequest;

    public function __construct()
    {
        $userAgent = env('NOMINATIM_USER_AGENT', config('app.name'));

        $this->pendingRequest = Http::withHeader('User-Agent', $userAgent)
            ->baseUrl($this->baseUrl);
    }

    public function search(string $query): ?array
    {
        while (RateLimiter::tooManyAttempts('nominatim-request', 1)) {
            usleep(100_000);
        }

        RateLimiter::hit('nominatim-request', 1);

        $response = $this->pendingRequest->get('search', [
            'q' => $query,
            'format' => 'json',
            'limit' => 1,
        ]);

        if ($response->successful()) {
            return $response->json()[0];
        }

        return null;
    }
}
