<?php

namespace Tests\Feature;

use App\Models\Airport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImportAirportsTest extends TestCase
{
    public function test_import_airports()
    {
        $this->artisan('app:import-airports')->assertSuccessful();

        $airports = Airport::query()->count();

        $this->assertGreaterThan(1, $airports);
    }
}
