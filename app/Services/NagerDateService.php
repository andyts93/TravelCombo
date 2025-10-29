<?php

namespace App\Services;

class NagerDateService extends BaseApiService
{
    protected string $baseUrl = 'https://date.nager.at/api/v3/publicholidays';

    public function getHolidays(int $year, string $country): ?array
    {
        $response = $this->pendingRequest->get("$year/$country");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
