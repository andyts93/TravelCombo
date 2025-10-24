<?php

namespace App\Console\Commands;

use App\Models\Airport;
use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ImportAirports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-airports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $csv = Reader::from(Storage::path('airports/countries.csv'));
        $csv->setHeaderOffset(0);
        $countries = $csv->getRecords();

        foreach ($countries as $country) {
            Country::query()->updateOrCreate(['id' => $country['code']], [
                'name' => $country['name'],
                'continent' => $country['continent']
            ]);
        }

        $csv = Reader::from(Storage::path('airports/airports.csv'));
        $csv->setHeaderOffset(0);
        $airports = $csv->getRecords();

        foreach ($airports as $airport) {
            if ($airport['iata_code']) {
                Airport::query()->updateOrCreate(['iata_code' => $airport['iata_code']], [
                    'ident' => $airport['ident'],
                    'name' => $airport['name'],
                    'country_id' => $airport['iso_country'],
                    'municipality' => $airport['municipality'],
                    'gps_code' => $airport['gps_code'],
                    'local_code' => $airport['local_code'],
                    'latitude' => $airport['latitude_deg'],
                    'longitude' => $airport['longitude_deg']
                ]);
            }
        }
    }
}
