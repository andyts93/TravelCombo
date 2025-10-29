<?php

namespace App\Services;

class UnsplashService extends BaseApiService
{
    protected string $baseUrl = 'https://api.unsplash.com';

    public function search(string $query, string $orientation = 'landscape'): ?array
    {
        $this->rateLimiter('unsplash-request');

        $response = $this->pendingRequest->withHeader('Authorization', 'Client-ID ' . env('UNSPLASH_APP_KEY'))->get('search/photos', [
            'query' => $query,
            'orientation' => $orientation
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
