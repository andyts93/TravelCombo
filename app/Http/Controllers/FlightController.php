<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function store(FlightRequest $request)
    {
        $data = $request->validated();

        try {
            $airportFrom = Airport::find($data['airport_from_id']);
            $data['date_from'] = Carbon::parse($data['date_from'], $airportFrom->timezone ?? 'UTC')->utc();
            $airportTo = Airport::find($data['airport_to_id']);
            $data['date_to'] = Carbon::parse($data['date_to'], $airportTo->timezone ?? 'UTC')->utc();

            if ($data['trip_type'] === 'round-trip') {
                $airportFrom = Airport::find($data['airport_from_id_return']);
                $data['date_from_return'] = Carbon::parse($data['date_from_return'], $airportFrom->timezone ?? 'UTC')->utc();
                $airportTo = Airport::find($data['airport_to_id_return']);
                $data['date_to_return'] = Carbon::parse($data['date_to_return'], $airportTo->timezone ?? 'UTC')->utc();
            }

            DB::transaction(function() use ($data) {
                $flight = Flight::query()->create([
                    'trip_id' => $data['trip_id'],
                    'airport_from_id' => $data['airport_from_id'],
                    'airport_to_id' => $data['airport_to_id'],
                    'date_from' => $data['date_from'],
                    'date_to' => $data['date_to'],
                    'price' => $data['price'],
                    'people' => $data['people'],
                    'trip_type' => 'outbound',
                ]);
                if ($data['trip_type'] === 'round-trip') {
                    $inbound = Flight::query()->create([
                        'linked_flight_id' => $flight->id,
                        'trip_id' => $data['trip_id'],
                        'airport_from_id' => $data['airport_from_id_return'],
                        'airport_to_id' => $data['airport_to_id_return'],
                        'date_from' => $data['date_from_return'],
                        'date_to' => $data['date_to_return'],
                        'price' => 0,
                        'people' => $data['people'],
                        'trip_type' => 'inbound'
                    ]);
                    $flight->linkedFlight()->associate($inbound);
                }
            });
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->with('airport-error', 'An error occurred, please try again.')->withInput();
        }

        return redirect()->back();
    }
}
