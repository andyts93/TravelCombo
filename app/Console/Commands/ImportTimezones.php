<?php

namespace App\Console\Commands;

use App\Models\Airport;
use App\Services\TimeZoneService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportTimezones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-timezones';

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
        $this->output->progressStart(Airport::query()->whereNull('timezone')->count());
        Airport::query()
            ->whereNull('timezone')
            ->chunkById(50, function ($airports) {
                foreach ($airports as $airport) {
                    $json = TimeZoneService::getTimezone($airport->latitude, $airport->longitude);
                    if ($json) {
                        $airport->update(['timezone' => $json->zoneName]);
                    }
                    $this->output->progressAdvance();
                    sleep(2);
                }
            });
        $this->output->progressFinish();
    }
}
