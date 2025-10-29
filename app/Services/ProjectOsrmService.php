<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ProjectOsrmService
{
    protected string $baseUrl = 'https://router.project-osrm.org';

    protected PendingRequest $pendingRequest;

    public function __construct()
    {
        $userAgent = env('NOMINATIM_USER_AGENT', config('app.name'));

        $this->pendingRequest = Http::withHeader('User-Agent', $userAgent)
            ->baseUrl($this->baseUrl);
    }

    public function route(string $profile, array $coords): ?array
    {
        $response = $this->pendingRequest->get(
            sprintf('%s/%s/%s/%s',
                $this->baseUrl,
                'route/v1',
                $profile,
                implode(';', array_map(fn($el) => implode(',', $el), $coords))
            )
        );

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
