<?php

namespace Tests\Feature;

use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripTest extends TestCase
{
    public function test_create_trip()
    {
        $response = $this->post(route('trip.store'), [
            'name' => 'Test',
            'country_id' => 'IT',
            'date_from' => '2025-01-01',
            'date_to' => '2025-01-12',
        ]);

        $this->assertDatabaseCount('trips', 1);

        $trip = Trip::query()->first();

        $response->assertRedirect(route('trip.edit', $trip));
    }
}
