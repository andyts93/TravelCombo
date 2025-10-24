<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function store(FlightRequest $request)
    {
        $data = $request->validated();

        $airportFrom = Airport::find($data['airport_from_id']);
        $data['date_from'] = Carbon::parse($data['date_from'], $airportFrom->timezone ?? 'UTC')->utc();

        $airportTo = Airport::find($data['airport_to_id']);
        $data['date_to'] = Carbon::parse($data['date_to'], $airportTo->timezone ?? 'UTC')->utc();

        try {
            Flight::query()->create($data);
        } catch (\Exception $exception) {
            return redirect()->back()->with('airport-error', 'An error occurred, please try again.')->withInput();
        }

        return redirect()->back();
    }
}
