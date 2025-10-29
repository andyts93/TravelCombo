<?php

namespace App\Services;

use DateInterval;
use DateTimeInterface;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

class BaseApiService
{
    protected string $baseUrl;

    protected PendingRequest $pendingRequest;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (empty($this->baseUrl)) {
            throw new Exception('baseUrl not set');
        }
        $userAgent = env('NOMINATIM_USER_AGENT', config('app.name'));

        $this->pendingRequest = Http::withHeader('User-Agent', $userAgent)
            ->baseUrl($this->baseUrl);
    }

    /**
     * Add a rate limiter to the API call to prevent spamming requests
     *
     * @param string $key RateLimiter key
     * @param DateTimeInterface|DateInterval|int $decaySeconds Seconds to wait
     * @param int $maxAttempts
     * @param int $usleep
     */
    protected function rateLimiter(string $key, DateTimeInterface|DateInterval|int $decaySeconds = 1, int $maxAttempts = 1, int $usleep = 100_000)
    {
        while (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            usleep($usleep);
        }

        RateLimiter::hit($key, $decaySeconds);
    }
}
