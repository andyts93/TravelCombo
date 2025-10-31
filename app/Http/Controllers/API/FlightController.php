<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function import(Request $request) {
        $data = $request->validate([
            'legs' => ['required', 'array'],
            'prices' => ['required', 'array']
        ]);

        $data['legs'] = array_map(function($leg) {
            $airportFrom = Airport::query()->firstWhere('iata_code', $leg['departureAirportCode']);
            $airportTo = Airport::query()->firstWhere('iata_code', $leg['arrivalAirportCode']);
            $dateFrom = Carbon::parse($leg['date'] . ' ' . $leg['departureTime'])->format('Y-m-d H:i');
            $dateTo = Carbon::parse($leg['date'] . ' ' . $leg['arrivalTime'])->format('Y-m-d H:i');
            return [
                'airportFrom' => $airportFrom,
                'airportTo' => $airportTo,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
            ];
        }, $data['legs']);

        return response()->json($data);
    }
}
